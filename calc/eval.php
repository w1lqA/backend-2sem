<?php

function evaluateExpressionWithTrig($expression) {
    $expression = str_replace('sin', 'sin_deg', $expression);
    $expression = str_replace('cos', 'cos_deg', $expression);
    $expression = str_replace('tan', 'tan_deg', $expression);

    $expression = preg_replace('/\s+/', '', $expression);

    if (!preg_match('#^[0-9+\-*/().a-z_]+$#i', $expression)) {
        return "Ошибка: недопустимые символы";
    }

    try {
        $result = eval("return $expression;");
        return $result;
    } catch (Throwable $e) {
        return "Ошибка: " . $e->getMessage();
    }
}

function sin_deg($deg) {
    return sin(deg2rad($deg));
}

function cos_deg($deg) {
    return cos(deg2rad($deg));
}

function tan_deg($deg) {
    return tan(deg2rad($deg));
}
