<!DOCTYPE html>
<html class="backend">
    <head>
        <style>
            /* general styling */
            * {
              box-sizing: border-box;
              margin: 0;
              padding: 0;
            }

            html, body {
              height: 100%;
              margin: 0;
            }

            body {
              align-items: center;
              background-color: #f7f565;
              display: flex;
              font-family: -apple-system, 
                BlinkMacSystemFont, 
                "Segoe UI", 
                Roboto, 
                Oxygen-Sans, 
                Ubuntu, 
                Cantarell, 
                "Helvetica Neue", 
                sans-serif;
            }

            .container {
              color: #333;
              margin: 0 auto;
              text-align: center;
            }

            h1 {
              font-weight: normal;
              letter-spacing: .125rem;
              text-transform: uppercase;
            }

            li {
              display: inline-block;
              font-size: 1.5em;
              list-style-type: none;
              padding: 1em;
              text-transform: uppercase;
            }

            li span {
              display: block;
              font-size: 4.5rem;
            }

            .emoji {
              display: none;
              padding: 1rem;
            }

            .emoji span {
              font-size: 4rem;
              padding: 0 .5rem;
            }

            @media all and (max-width: 768px) {
              h1 {
                font-size: 1.5rem;
              }
              
              li {
                font-size: 1.125rem;
                padding: .75rem;
              }
              
              li span {
                font-size: 3.375rem;
              }
            }
        </style>

        <title>Spec - Baramuda Bahari</title>
    </head>
    <body>
        <div class="container">
          <h1 id="headline">Under Development <br>Coming Soon:</h1>
          <div id="countdown">
            <ul>
              <li><span id="days"></span>days</li>
              <li><span id="hours"></span>Hours</li>
              <li><span id="minutes"></span>Minutes</li>
              <li><span id="seconds"></span>Seconds</li>
            </ul>
          </div>
          <h4> IT Dept | PT. Baramuda Bahari </h4>
          <div id="content" class="emoji">
            <span>🥳</span>
            <span>🎉</span>
            <span>🎂</span>
          </div>
        </div>

        <script>
            (function () {
              const second = 1000,
                    minute = second * 60,
                    hour = minute * 60,
                    day = hour * 24;

              let birthday = "Sep 01, 2021 12:00:00",
                  countDown = new Date(birthday).getTime(),
                  x = setInterval(function() {    

                    let now = new Date().getTime(),
                        distance = countDown - now;

                    document.getElementById("days").innerText = Math.floor(distance / (day)),
                      document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                      document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                      document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

                    //do something later when date is reached
                    if (distance < 0) {
                      let headline = document.getElementById("headline"),
                          countdown = document.getElementById("countdown"),
                          content = document.getElementById("content");

                      headline.innerText = "Let's Go!";
                      countdown.style.display = "none";
                      content.style.display = "block";

                      clearInterval(x);
                    }
                    //seconds
                  }, 0)
              }());
        </script>
    </body>
</html>