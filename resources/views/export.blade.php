<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ $resume->title }}</title>
    </head>
    <body>
        <h1>{{ $resume->title }}</h1>
        <h2>Education</h2>
        <ul>
            @foreach ($education as $edu)
                <li>{{ $edu->school_name }} ({{ $edu->degree }})</li>
            @endforeach
        </ul>
        <h2>Experience</h2>
        <ul>
            @foreach ($experience as $exp)
                <li>{{ $exp->company_name }} - {{ $exp->position }}</li>
            @endforeach
        </ul>
         <h2>Skills</h2>
        <ul>
            @foreach ($skills as $skill)
                <li>{{ $skill->skill }} ({{ $skill->level }})</li>
            @endforeach
        </ul>
    </body>
</html>