<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Exam Result </title>
</head>
<style>
     .header-table {
        width: 100%; border-collapse: collapse;
        margin-bottom: 30px;  border-bottom: 3px solid #007bff;
    }

    .header-table td {
        padding: 10px; vertical-align: top;
    }

    .header-left h3,
    .header-center h3,
    .header-right h3 {
        margin: 0; font-size: 20px; color: #333;
    }

    .section-title {
        font-size: 18px;  color: #444; margin-bottom: 10px;
    }

    .info-table {
        width: 100%; border-collapse: collapse; margin-bottom: 20px;
    }

    .info-table td { padding: 8px 10px; }

    .logo-box { text-align: center; }

    .logo-box img { max-height: 60px; }
</style>

<body>
   <table class="header-table">
    <tr>
        <td class="header-left" style="width: 40%;">
            <h3>SMS - Student Management System</h3>
        </td>
        <td class="header-center logo-box" style="width: 30%;">
            <img src=" " alt="Logo">
        </td>
        <td class="header-right" style="width: 30%;">
            <h3>Address: Riyadh, Saudi Arabia</h3>
        </td>
    </tr>
</table>

<table class="info-table">
    <tr>
        <td style="width: 50%;"><h4 class="section-title">Student Name:</h4></td>
        <td style="width: 30%;"><h4 class="section-title">Class:</h4></td>
        <td style="width: 20%;"><h4 class="section-title">Roll No:</h4></td>
    </tr>
</table>

<script type="text/javascript">
    //  window.print();
</script>

</body>
</html>