<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/User/appointment.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
      <a href="{{ route('views.Homepage') }}">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo">
      </a>
      <nav>
        <ul class="nav_links">
          
          <li><a>Journal</a></li>
          <li><a style="color:#FFDB99" href="views.appointment">Appointment</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Chat</a></li>
        </ul>
      </nav>
    <img style="width:50px; margin-left:15px;" src="images/profile.png" alt="profile">
    </header>
    <main class="appointment-container">
  <section class="left-section">
    <h1>Book Appointment</h1>

    <div class="categories">
      <h3>Categories</h3>
      <p>Now we may help you?</p>
      <div class="category-buttons">
        <button>Counselor</button>
        <button class="active">Psychologist</button>
        <button>Therapist</button>
      </div>
    </div>

    <div class="psychiatrist-list">
      <h3>Choose Psychiatrist</h3>
      <p>Available Psychiatrist</p>
      <div class="cards">
        <div class="card">
          <img src="{{ asset('images/doctor1.png') }}" alt="Fariz Cipularang">
          <h4>FARIZ CIPULARANG, Ph.D</h4>
          <p>General Practitioner</p>
        </div>
        <div class="card">
          <img src="{{ asset('images/doctor2.png') }}" alt="Mayla Brebes">
          <h4>MAYLA BREBES, M.D.</h4>
          <p>General Practitioner</p>
        </div>
        <div class="card">
          <img src="{{ asset('images/doctor3.png') }}" alt="Jamal Cil">
          <h4>JAMAL CIL</h4>
          <p>General Practitioner</p>
        </div>
      </div>
    </div>
  </section>

  <section class="right-section">
    <div class="calendar-section">
      <h3>Select Date</h3>
      <div class="calendar">
        <div class="calendar-header">
          <span>&lt;</span>
          <h4>September 2025</h4>
          <span>&gt;</span>
        </div>
        <div class="calendar-days">
          <div>SUN</div><div>MON</div><div>TUE</div><div>WED</div><div>THU</div><div>FRI</div><div>SAT</div>
          <!-- Example days (should be generated dynamically in real app) -->
          <div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div><div>7</div>
          <div>8</div><div>9</div><div>10</div><div>11</div><div>12</div><div>13</div><div>14</div>
          <div>15</div><div>16</div><div>17</div><div>18</div><div>19</div><div>20</div><div>21</div>
          <div>22</div><div>23</div><div>24</div><div>25</div><div>26</div><div>27</div><div>28</div>
          <div>29</div><div>30</div><div>31</div>
        </div>
      </div>
    </div>

    <div class="payment-section">
      <h3>Payment Information</h3>
      <ul>
        <li>Counselling Session: IDR 200,000 per session</li>
        <li>Psychologist Consultation: IDR 200,000 per session</li>
        <li>Physiotherapy Session: IDR 100,000 per session</li>
      </ul>

      <div class="upload">
        <label for="proof">Proof of Payment</label>
        <input type="file" id="proof" name="proof">
      </div>

      <p class="note">After completing your payment, please upload your proof of payment through our secure payment portal. If you have any questions or issues, feel free to contact our support team.</p>

      <button class="send-btn">Send</button>
    </div>
  </section>
</main>
</body>
</html>
