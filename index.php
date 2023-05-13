<!DOCTYPE html>
<html>
<head>
  <title>Talking Ben</title>
  <style>
   * {
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);      
    }
    .conversation {
      display: flex;
      flex-direction: column;
    }
    .message {
      display: flex;
      margin-bottom: 10px;
    }
    .message-bubble {
      max-width: 70%;
      border-radius: 25px;
      padding: 10px;
      font-size: 14px;
      line-height: 1.2em;
    }
    .message-bubble.user {
      background-color: #0084ff;
      color: #fff;
      border-radius: 25px 25px 0 25px;
      margin-left: auto; /* <-- align user bubble to the right */
      text-align: right;
    }
    .message-bubble.ben {
      background-color: #c9c9c9;
      color: #000;
      border-radius: 25px 25px 25px 0;
      margin-right: auto;  /* <-- align ben bubble to the left */
      text-align: left;
    }
    .message-bubble:last-child {
      margin-right: 20px;
    }
    form {
      display: flex;
    }
    input[type="text"] {
      flex: 1;
      margin-right: 10px;
      padding: 10px;
      border-radius: 25px;
      border: none;
      font-size: 16px;
      font-weight: bold;
    }
    button {
      padding: 10px;
      border-radius: 25px;
      border: none;
      background-color: #0084ff;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #0072d6;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Talking Ben</h1>
    <div class="conversation">
      <?php
        session_start();

        // Array of possible responses from "Ben"
        $benResponses = array("Yes", "No", "Ho ho ho!", "Ugh.", "Ben?");

        // Initialize the conversation messages array
        if (!isset($_SESSION['conversation'])) {
          $_SESSION['conversation'] = array();
        }

        if (isset($_POST['submit'])) {
          // Get the submitted message and add it to the conversation array
          $userMessage = $_POST['message'];
          array_push($_SESSION['conversation'], array("from" => "user", "message" => $userMessage));

          // Generate a random response from Ben and add it to the conversation array
          $benMessage = $benResponses[array_rand($benResponses)];
          array_push($_SESSION['conversation'], array("from" => "ben", "message" => $benMessage));
        }

        // Display the conversation messages
        foreach ($_SESSION['conversation'] as $message) {
          $from = $message['from'];
          $text = $message['message'];
          
          if ($from == 'user') {
            echo '<div class="message"><div class="message-bubble user">' . $text . '</div></div>';
          } else {
            echo '<div class="message"><div class="message-bubble ben">' . $text . '</div></div>';
          }
        }
      ?>
    </div>
    <form method="POST" action="">
      <input type="text" name="message" placeholder="Type your message...">
      <button type="submit" name="submit">Send</button>
    </form>
  </div>
</body>
</html>
