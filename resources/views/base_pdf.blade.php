<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="{{ public_path('office/css/app.31e1472a.css') }}" />
        <style>
            @font-face{
            font-family:  'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
            }
            @font-face{
            font-family:  'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew-Bold.ttf') }}") format('truetype');
            }
            @font-face{
            font-family:  'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew-Italic.ttf') }}") format('truetype');
            }
            @font-face{
            font-family:  'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew-BoldItalic.ttf') }}") format('truetype');
            }
            body{
            font-family: "THSarabunNew";
            font-size: 16px;
            }
            @page {
            size: A4;
            padding: 15px;
            }
            @media print {
                html, body {
                    width: 210mm;
                    height: 297mm;
                    /*font-size : 16px;*/
                }
            }
        </style>
    </head>
<body>
    <h1>Test</h1>
    <h2>ทดสอบภาษาไทย</h2>
    {!!$data!!}
</body>
</html>
