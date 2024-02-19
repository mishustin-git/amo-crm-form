<?php
    // Подключаем класс lead и создаем объект
    include "lead.php";
    $lead_form = new Lead();
    // заполняем поля объекта данными из формы или отправляем на главную страницу
    if ($_POST){
        $lead_form->setName($_POST['name']);
        $lead_form->setEmail($_POST['email']);
        $lead_form->setPhone($_POST['phone']);
        $lead_form->setCost($_POST['cost']);
        $lead_form->setHidden($_POST['hidden']);
    }
    else{
        header('Location: https://mishustin.space');
    }
    $lead_form->setLink('https://mishustinpostmailru.amocrm.ru/api/v4/leads/complex');
    $lead_form->setToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImVmZDk4NmZhYTgyZjc3YjIwYWFlZTA5NWVjNjYwMmUxMjZhNDdhNDM1MDdmMzZmZmMyYThkNTJmZmUzMzlhOTVhZmRkYTY1NjljMjQzMzg1In0.eyJhdWQiOiI3YjQxZDgxNi0xZmM2LTQ5NTEtOWRkYS01MWI2OGJmNmNhN2UiLCJqdGkiOiJlZmQ5ODZmYWE4MmY3N2IyMGFhZWUwOTVlYzY2MDJlMTI2YTQ3YTQzNTA3ZjM2ZmZjMmE4ZDUyZmZlMzM5YTk1YWZkZGE2NTY5YzI0MzM4NSIsImlhdCI6MTcwODI5NjI2NCwibmJmIjoxNzA4Mjk2MjY0LCJleHAiOjE3MDkxNjQ4MDAsInN1YiI6IjEwNjkxMzE0IiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxNTc4MjM0LCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iLCJmaWxlcyIsImZpbGVzX2RlbGV0ZSIsIm5vdGlmaWNhdGlvbnMiLCJwdXNoX25vdGlmaWNhdGlvbnMiXSwiaGFzaF91dWlkIjoiZGNhNTVhNGUtYTg3Ni00YTY1LWIxZGEtMmQxNDZjNjFkODdkIn0.VvGdHW-bJhlk71mcRKrEWCJbnP0HKV2h3mzyXqfu_3egydgOVcyz-1HL3PaJseiU-XXOMuC-52xRHeChPPTNOiXyjVsp6m2T-x7oumS7eCrPR8cTx_FilG4bufI6NY7ejnfIvZ6-9xivUsnnWiYThjE1jiBsqWgNcs9LpNQ0aJUVKpXNaEBA_8luJJSVeVsFPd76c0bcmVBmf2yh9eFgOBewxTwl3Mr__n3EnCiXqUnxNtq_XloQffWH-ppfQwTpaYIhkO6W7DobZXg0BlOFo5yeXAXc5WDc4yIkwKGWbLo__WPYOGVaWie7md3WlbFcKPdNSPIUf7XNC6AmcmwxWg');
    $lead_form->createAmoLead();
?>