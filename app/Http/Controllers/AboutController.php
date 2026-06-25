<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $history = [
            ['year' => 2021, 'date' => '23 октября', 'title' => 'Основание', 'desc' => 'Создание агентства «Фокус», запуск первых рубрик.'],
            ['year' => 2022, 'date' => '10 ноября', 'title' => 'Первая редакция Forbes 01', 'desc' => 'Публикация первой редакции Forbes на сервере 01.'],
            ['year' => 2023, 'date' => '5 июня', 'title' => 'Первая редакция Forbes 02, 03, 04', 'desc' => 'Публикация первой редакции Forbes на серверах 02, 03, 04.'],
            ['year' => 2024, 'date' => '15 января', 'title' => 'Первый FOCUS Awards', 'desc' => 'Награждение победителей первой премии "FOCUS Awards 2023"'],
        ];
        
        $team = [
            ['name' => 'Dimas_Lean', 'role' => 'Основатель, Главный редактор Forbes', 'image' => 'dimas.jpg'],
            ['name' => 'Professor_Crew', 'role' => 'Сооснователь, советник, редактор Forbes', 'image' => 'professor.jpg'],
            ['name' => 'Nikki_Crew', 'role' => 'Советник, главный аналитик', 'image' => 'nikki.jpg'],
            ['name' => 'Donya_Hoodthugger', 'role' => 'Редактор, репортёр', 'image' => 'donya.jpg'],
            ['name' => 'Forbes_Malinovka', 'role' => 'Главный проверяющий', 'image' => 'forbes.jpg'],
            ['name' => 'Shakug_Kugshovich', 'role' => 'Редактор, репортёр, проверяющий', 'image' => 'shakug.jpg'],
            ['name' => 'Z1dipex', 'role' => 'Специалист по учёту имущества, аналитик', 'image' => 'z1dipex.jpg'],
            ['name' => 'Casper_Corrado', 'role' => 'Специалист по учёту имущества, аналитик', 'image' => 'casper.jpg'],
        ];
        
        return view('about', compact('history', 'team'));
    }
}