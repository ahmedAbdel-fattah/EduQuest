<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/certificate.css')}}">


    <title>Certificate of Completion</title>
</head>
<body>
<div class="certificate">

    <div class="certificate-content">
        <div class="certificate-logo">
            <h1><span style="color:orange ;">Edu</span><span style="color:#6200EA ;">Quest</span></h1>
        </div>
        <h2>Certificate of Completion</h2>
        <h2>This certifies that</h2>
        <p class="student-name">{{$user->name}}</p>
        <h2>has successfully completed the course</h2>
        <p class="course-title">{{$course->title}}</p>
        <p>Date: <span class="date">{{$currentDate->format('F j, Y')}}</span></p>
        <div class="certificate-footer">
            <p>Instructor: <span class="instructor-name">{{$instructor->name}}</span></p>
        </div>
    </div>
</div>


<button onclick="generateCertificate('{{$user->name}}', '{{$course->title}}', '{{$currentDate->format('F j, Y')}}', '{{$instructor->name}}')" class="btn">Download Certificate</button>

<!-- <script src="script.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    function generateCertificate(studentName, courseTitle, date, instructorName) {
        const certificateElement = document.querySelector('.certificate');

        // Insert student details into the certificate dynamically
        document.querySelector('.student-name').innerText = studentName;
        document.querySelector('.course-title').innerText = courseTitle;
        document.querySelector('.date').innerText = date;
        document.querySelector('.instructor-name').innerText = instructorName;

        html2canvas(document.querySelector('.certificate'), {
            useCORS: true, // Ensure CORS for external images
            scale: 2, // Higher scale for better quality
        }).then(canvas => {
            const imageData = canvas.toDataURL('image/png'); // Convert canvas to image

            // Create download link for PNG
            const link = document.createElement('a');
            link.href = imageData;
            link.download = `Certificate_${studentName}.png`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Get the dimensions of the certificate
            const certificateWidth = canvas.width;
            const certificateHeight = canvas.height;

            // Generate PDF using jsPDF
            const doc = new jsPDF({
                orientation: certificateWidth > certificateHeight ? 'landscape' : 'portrait', // Landscape or portrait based on dimensions
                unit: 'px',
                format: [certificateWidth, certificateHeight], // Set the format based on certificate dimensions
            });

            // Add the image to the PDF
            doc.addImage(imageData, 'PNG', 0, 0, certificateWidth, certificateHeight);

            // Save the generated PDF
            doc.save(`Certificate_${studentName}.pdf`);
        }).catch(error => {
            console.error('Error generating certificate:', error);
        });

    }


</script>
</body>
</html>
