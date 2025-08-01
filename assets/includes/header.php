<?php
require './assets/class/function.class.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?=@$title?></title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

    <link rel="icon" href="./assets/images/logo.png" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />

    <style>
      :root {
        /* Modern Color Scheme - Matching Dashboard */
        --primary: #4361ee;
        --primary-light: rgba(67, 97, 238, 0.1);
        --primary-dark: #3a56d5;
        --light: #f8f9fa;
        --lighter: #ffffff;
        --dark: #212529;
        --darker: #1a1a1a;
        
        /* Current Theme Defaults */
        --bg: var(--light);
        --text: var(--dark);
      }

      body.dark-mode {
        --bg: var(--darker);
        --text: var(--light);
      }

      body {
        background: var(--bg);
        color: var(--text);
        transition: background 0.3s ease, color 0.3s ease;
      }
    </style>
  
  </head>

 
    <script>
      // Theme handling - matches dashboard implementation
      document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = localStorage.getItem("theme") || "light";
        document.body.classList.toggle("dark-mode", savedTheme === "dark");
      });
    </script>
