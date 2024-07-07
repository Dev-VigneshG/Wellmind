<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chatbot</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .wrapper{
            position: relative;
            top:-25%;
            width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
        }
        .title{
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid #f4f4f4;
            padding-bottom: 10px;
        }
        .form{
            height: 300px;
            overflow-y: auto;
        }
        .inbox{
            display: flex;
            align-items: center;
            padding: 10px;
            margin: 10px 0;
        }
        .bot-inbox{
            justify-content: flex-start;
        }
        .user-inbox{
            justify-content: flex-end;
        }
        .icon{
            height: 50px;
            width: 50px;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 25px;
        }
        .msg-header{
            padding: 10px;
            background: #f4f4f4;
            border-radius: 10px;
            margin: 0 10px;
        }
        .msg-header p{
            margin: 0;
        }
        .typing-field{
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .input-data{
            width: 85%;
        }
        .input-data input{
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #f4f4f4;
            border-radius: 5px;
        }
        .input-data button{
            /* padding: 10px 10px; */
            font-size: 16px;
            background: #f4f4f4;
            border: 1px solid #f4f4;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="title">Yours Healer</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hello dear, How can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Please type something here.." required>
                <button id="send-btn">Talk</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
    
</body>
</html>