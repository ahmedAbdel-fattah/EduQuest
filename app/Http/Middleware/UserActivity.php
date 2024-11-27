<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\CourseDeclineController;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
{
    // احفظ الطلب الأصلي قبل تنفيذ أي منطق
    $response = $next($request);

    // دعنا نسجل النشاط فقط إذا كان المستخدم مسجل دخول
    if (Auth::check()) {
        $user = Auth::user();

        // تأكد من أن المستخدم موجود وله اسم
        if (!$user || empty($user->name)) {
            return $response; // تجنب تسجيل نشاط بدون مستخدم صالح
        }

        $action = $this->getActionBasedOnMethod($request->method());

        // تحقق إذا كان هناك نشاط مهم للتسجيل
        if ($action) {
            $status = $this->determineStatus($response->status());

            // سجل النشاط
            Activity::create([
                'user_id' => $user->id,
                'description' => "{$user->name} {$action} a resource on " . $request->path() . " with status code " . $response->status(),
                'status' => $status, // إما 'completed' أو 'failed' بناءً على الاستجابة
                'created_at' => now(),
            ]);
        }
    }

    return $response;
}

/**
 * تحديد الإجراء بناءً على نوع الطلب HTTP.
 *
 * @param string $method
 * @return string|null
 */
protected function getActionBasedOnMethod(string $method): ?string
{
    switch (strtolower($method)) {
        case 'post':
            return 'created';
        case 'put':
        case 'patch':
            return 'updated';
        case 'delete':
            return 'deleted';
        default:
            return null; // إذا لم يكن الإجراء مهمًا، لا داعي للتسجيل
    }
}

/**
 * تحديد حالة النشاط بناءً على كود حالة HTTP.
 *
 * @param int $statusCode
 * @return string
 */
protected function determineStatus(int $statusCode): string
{
    return $statusCode >= 400 ? 'failed' : 'completed';
}


}
