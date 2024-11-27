<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        // يمكنك إضافة مستويات معينة للخطأ هنا
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        // استثناءات التي لا تحتاج إلى التسجيل
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->renderable(function (Throwable $e, Request $request) {
            // إذا كان خطأ HttpException (مثل 404 أو 500)
            // if ($e instanceof HttpException) {
                // إذا كانت الصفحة السابقة غير متاحة أو NULL، سيتم إعادة التوجيه إلى الـ Dashboard
                // return $request->headers->get('referer')
                    // ? redirect()->back()->with('error', 'Something went wrong. Please try again.')
                    // : redirect()->route('dashboard')->with('error', 'Something went wrong.');
            // }

            // في حالة خطأ غير معالج
            // return $request->headers->get('referer')
                // ? redirect()->back()->with('error', 'Something went wrong.')
                // : redirect()->route('dashboard')->with('error', 'Something went wrong.');
        // });
    }
}
