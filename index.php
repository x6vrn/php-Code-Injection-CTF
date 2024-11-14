<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Command Execution Tool</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1c1c1e;
            color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: #2c2c2e;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #ff6f61;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            width: calc(100% - 20px);
            margin-top: 15px;
            background: #3a3a3c;
            color: #ffd966;
            text-align: center;
        }
        input[type="submit"] {
            background-color: #ff6f61;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #e25447;
        }
        .output-box {
            background: #3a3a3c;
            border-radius: 8px;
            padding: 15px;
            color: #ffd966;
            text-align: left;
            white-space: pre-wrap;
            margin-top: 20px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Command Execution</h1>
        <form method="GET">
            <input type="text" name="cmd" placeholder="Enter command" required />
            <input type="submit" value="Run Command" />
        </form>

        <?php
        if (isset($_GET['cmd'])) {
            $cmd = $_GET['cmd'];
            $blacklist = ['system', 'exec', 'passthru', 'shell_exec', 'eval', 'assert'];
            $is_blacklisted = false;

            foreach ($blacklist as $blacklisted_function) {
                if (stripos($cmd, $blacklisted_function) !== false) {
                    $is_blacklisted = true;
                    break;
                }
            }

            if ($is_blacklisted) {
                echo "<div class='output-box'>Command not allowed.</div>";
            } else {
                echo "<div class='output-box'>";
                eval($cmd);
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
