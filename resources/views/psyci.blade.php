<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>

  <style>
    .review {
      margin:70px 50px;
    }

    .review_child{
      background-color: #EDEDED;
      padding:30px;
      border-radius:20px;
    }

    .review_scroll {
      margin:30px 50px;
      display:flex;
      flex-direction: column;
      gap: 40px;
      height: 400px;
      overflow: auto;
      padding-right: 5px;
    }

    .review_scroll p {
      background-color: white;
      padding:40px;
      border-radius:20px;

    }

    .review_scroll::-webkit-scrollbar {
      width: 10px;
    }

    .review_scroll::-webkit-scrollbar-thumb {
      background: #7F7F7F; 
      border-radius: 10px;
    }
  </style>
  <body>
    <header style="display: flex; align-items: center; padding: 10px 20px;">
      <img class="logo" src="images/logo.png" alt="logo">
      <nav style="margin-left: 20px; flex-grow: 1;">
        <ul class="nav_links" style="display: flex; gap: 20px; list-style: none; margin: 0; padding: 0;">
          <li><a href="#">Appointment</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="{{ route('psychchat.index') }}">Chat</a></li>
        </ul>
      </nav>

      <div style="display: flex; align-items: center; gap: 10px;">
        <img style="width:50px;" src="images/profile.png" alt="profile">
        <form method="POST" action="{{ route('psychologist.logout') }}">
          @csrf
          <button type="submit" 
                  style="
                    padding: 8px 12px;
                    background-color: #e74c3c;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                  ">
            Logout
          </button>
        </form>
      </div>
    </header>

    
    <script src="navIndex.js" async defer></script>

    
    <div class="hero">
      <div class="hero_content">
        <h1>Explore General Counseling Topics</h1>
        <div class="topic">
            <div class="topic1"></div>
            <div class="topic2"></div>
            <div class="topic3"></div>
            <div class="topic4"></div>
            <div class="topic5"></div>
            <div class="topic6"></div>
        </div>
        <div class="hero_text">
            <p>
            Stress isn’t always harmful, but prolonged stress can affect your health. It often stems from new experiences or situations beyond your control. While stress is a natural part of life, finding healthy ways to cope can make a significant difference in your well-being.
            </p>

            <div class="see_more">
                 <a href="/symtom">See more ></a>
            </div>
        </div>
      </div>

      <div class="hero_index">
          <img src="images/doctor1.png">
      </div>
    </div>
    
    
    <div class= "review">

      <h1>Review By Users</h1>

      <div class="review_child">
        <h1> Recents</h1>
        <div class="review_scroll">
          <!-- DUMMY -->
          <div>
            <p>test</p>
          </div>
          <div>
            <p>test</p>
          </div>
          <div>
            <p>test</p>
          </div>
          <div>
            <p>test</p>
          </div>

        </div>
    </div>


    <div class= "news">
      <h1>Read about mental health</h1>
      <h2>Tips & info blablablalbalbal</h2>

      <div class= "news_container">
        <div class= "news_content">
          <img src="images/news.png">
          <div class="news_text">
            <h3>7 Alasan kenapa menjadi pengangguran itu buruk bagi kesehatan mental</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla par</p>
          </div>
        </div>


        <div class= "news_content">
          <img src="images/news.png">
          <div class="news_text">
            <h3>7 Alasan kenapa menjadi pengangguran itu buruk bagi kesehatan mental</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla par</p>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <div class="footer_bg">
        <img src="images/PSYLO GRAPHY.png">
        <div class="footer_text">
            <div class="book_footer">
                <h1>Consult Now</h1>
                <hr>
                <div class="footer_opt">
                    <a href="{{ url('appointments') }}">Chat With Psychiatrist</a>
                </div>
            </div>
            <div class="discover_footer">
                <h1>Discover Us</h1>
                <hr>
                <div class="footer_opt">
                    <a href="#about_us">About Us</a>
                    <a href="{{ url('doctors') }}" >Our Psychiatrist</a>
                </div>
            </div>
            <div class="contact_footer">
                <h1>Contact Us</h1>
                <hr>
                <div class="footer_opt">
                  <a href="tel:1500115">14022</a>
                  <a href="mailto:cs@telkomedika.co.id">cs@psylo.co.id</a>
                </div>
            </div>
        </div>
      </div>

      <div class="line"></div>
    </footer>
  </body>



</html>

