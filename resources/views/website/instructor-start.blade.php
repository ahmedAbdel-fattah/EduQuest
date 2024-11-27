<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Start</title>
    <link rel="stylesheet" href="{{ asset('css/instructor-start.css') }}">
</head>
<body>

    <div class="container">
        <!-- الصفحة الأولى: جملة البداية وزر الاستمرار -->
        <div id="start-page" class="step">
            <h1>Let's Start an Exciting Journey!</h1>
            <button class="btn" onclick="showQuestion({{ $questions->first()->id }})">Continue</button>
        </div>

        <!-- الأسئلة -->
        <form action="{{ route('submit.answers') }}" method="POST" id="questions-form">
            @csrf <!-- لإضافة توكن الحماية في Laravel -->

            @foreach ($questions as $index => $question)
                <!-- السؤال -->
                <div id="question{{ $question->id }}" class="step" style="display: none;">
                    <h1>{{ $question->question_title }}</h1>

                    <!-- عرض الخيارات المخزنة في الأعمدة -->
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question->choice1 }}" required>
                        {{ $question->choice1 }}
                    </label><br>
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question->choice2 }}">
                        {{ $question->choice2 }}
                    </label><br>
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question->choice3 }}">
                        {{ $question->choice3 }}
                    </label><br>

                    <span class="error-message" id="error{{ $question->id }}"></span>

                    <!-- زر العودة إلى السؤال السابق -->
                    @if($index > 0)
                        <button type="button" class="btn" onclick="showPrevious({{ $questions[$index - 1]->id }})">Previous</button>
                    @endif

                    <!-- زر السؤال التالي أو زر الإرسال -->
                    @if($index < count($questions) - 1)
                        <button type="button" class="btn" onclick="validateAndProceed({{ $question->id }}, {{ $questions[$index + 1]->id }})">Next</button>
                    @else
                        <button type="submit" class="btn">Submit</button>
                    @endif
                </div>
            @endforeach

        </form>
    </div>

    <!-- JavaScript للتحكم في عرض الأسئلة والتحقق -->
    <script>
        function showQuestion(step) {
            document.querySelectorAll('.step').forEach(function(div) {
                div.style.display = 'none';
            });
            document.getElementById('question' + step).style.display = 'block';
        }

        function validateAndProceed(currentStep, nextStep) {
            const errorElement = document.getElementById('error' + currentStep);
            const isChecked = document.querySelector('input[name="answers[' + currentStep + ']"]:checked');

            if (isChecked) {
                errorElement.textContent = ''; // إخفاء رسالة الخطأ
                showQuestion(nextStep);
            } else {
                errorElement.textContent = 'Please select an answer before proceeding.'; // رسالة خطأ
                errorElement.style.color = 'orange';
            }
        }

        function showPrevious(previousStep) {
            showQuestion(previousStep);
        }
    </script>

</body>
</html>
