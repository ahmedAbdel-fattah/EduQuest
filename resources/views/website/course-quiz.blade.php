@extends('website.layouts.instructor-dash')
@section('courses')
    active
@endsection
@section('content')


    <div class="quiz-form" style="margin-left: 400px">
        <center>
            <header>
                <h1>Adding Quiz</h1>
            </header>
        </center><br>
        <form method="POST" action="{{ route('quizzes.store') }}">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">

            <div class="form-group">
                <label for="title">Quiz Title:</label>
                <input type="text" name="title"  id="title" required style="width:500px ">
            </div>
            <!-- Number of 4-option questions -->
            <div class="form-group">
                <label for="four-option-questions">Number of 4-option Questions:</label>
                <input type="number" id="four-option-questions"  name="four_option_questions" min="0" required style="width:500px ">
            </div>

            <!-- Number of 2-option questions -->
           <div class="form-group">
               <label for="two-option-questions">Number of 2-option Questions:</label>
               <input type="number" id="two-option-questions"  name="two_option_questions" min="0" required style="width:500px ">
           </div>


            <button type="button" class="btn-view" onclick="generateQuestions()">Generate Questions</button>
            <br><br>
            <div id="questions-container"></div>
            <div class="form-group">
                <label for="section_no">This Quiz will be displayed after which section :</label>
                <input type="number" id="section_no"  name="section_no" min="1" required style="width:500px ">
            </div>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>

    <script>
        function generateQuestions() {
            const fourOptionQuestions = document.getElementById('four-option-questions').value;
            const twoOptionQuestions = document.getElementById('two-option-questions').value;

            const questionsContainer = document.getElementById('questions-container');
            questionsContainer.innerHTML = ''; // Clear previous questions

            // Generate 4-option questions
            for (let i = 1; i <= fourOptionQuestions; i++) {
                questionsContainer.innerHTML += `
                    <div class="question-set">
                        <h4>4-Option Question ${i}</h4>
                        <div class="form-group">
                           <label for="question_${i}">Question:</label>
                           <input type="text" name="questions[${i}][question]" required style="width:500px ">
                        </div>
                      <div class="form-group">
                        <div class="options">
                            <label>Option 1:</label>
                            <input type="text" name="questions[${i}][options][]" required style="width:500px ">

                            <label>Option 2:</label>
                            <input type="text" name="questions[${i}][options][]" required style="width:500px ">

                            <label>Option 3:</label>
                            <input type="text" name="questions[${i}][options][]" required style="width:500px ">

                            <label>Option 4:</label>
                            <input type="text" name="questions[${i}][options][]" required style="width:500px ">
                        </div>
                       </div>
                    <div class="form-group">
                        <label for="correct_answer_${i}">Correct Answer (1-4):</label>
                        <input type="number" name="questions[${i}][correct_answer]" min="1" max="4" required style="width:500px ">
                    </div>
                    </div>
                `;
            }

            // Generate 2-option questions
            for (let i = 1; i <= twoOptionQuestions; i++) {
                const qIndex = parseInt(fourOptionQuestions) + i;
                questionsContainer.innerHTML += `
                    <div class="question-set">
                        <h4>2-Option Question ${i}</h4>
<div class="form-group">
                        <label for="question_${qIndex}">Question:</label>
                        <input type="text" name="questions[${qIndex}][question]" required style="width:500px ">
</div>
<div class="form-group">
                        <div class="options">
                            <label>Option 1:</label>
                            <input type="text" name="questions[${qIndex}][options][]" required style="width:500px ">

                            <label>Option 2:</label>
                            <input type="text" name="questions[${qIndex}][options][]" required style="width:500px ">
                        </div>
</div>
<div class="form-group">
                        <label for="correct_answer_${qIndex}">Correct Answer (1-2):</label>
                        <input type="number" name="questions[${qIndex}][correct_answer]" min="1" max="2" required style="width:500px ">
                    </div>
</div>
                `;
            }
        }
    </script>
@endsection
