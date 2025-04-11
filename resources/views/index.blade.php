<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telkomedika</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">


</head>
<body>

    <div id="header">
        <header>
            <div class="logo">
                <img src="icons/logo.png" alt="Telkomedika">
            </div>

            <div class="navigation">
                <div class="top_header">
                    <div class="top_headerchild">
                        <div class="contact">
                            <div class="contact_item">
                                <img src="icons/email icon.png">
                                <p>cs@telkomedika.co.id</p>
                            </div>
                            <div class="contact_item">
                                <img src="icons/phone icon.png">
                                <p>1500115</p>
                            </div>
                        </div>
                    </div>

                    <div class="log_sign">
                        <div class="log_in">
                            <a href="{{ url('patients/login') }}">
                                <button>Log In</button>
                            </a>
                        </div>
                        <div class="sign_in">
                            <a href="{{ url('patients/create') }}">
                                <button>Sign Up</button>
                            </a>
                        </div>
                    </div>
                    
                </div>

                <div class="main_header">
                    <nav>
                        <ul style="list-style-type:none;" class="nav">
                            <li class="main_nav"><a href="#services">Our Services</a></li>
                            <li class="main_nav"><a href="{{ url('doctors') }}">Doctors</a></li>
                            <li class="main_nav"><a href="{{ url('symptoms') }}">Check Symptoms</a></li>
                            <li class="main_nav"><a href="{{ url('medicines') }}">Medicine</a></li> 
                            <li class="gradient">
                                <a href="{{ url('appointments') }}"><button> Book Appointment > </button></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>   
        </header>
    </div>

    <div class="hero">
        <div class="heroindex">
            <img src="images/hero.png">
        </div>
        <div class="hero_text">
            <h1>
                <span class="highlight">Telkomedika:</span> Your Trusted Partner in Health and Well-being
            </h1>
            <p>
                Providing Integrated Health Solutions Online: Book Appointments, Order From Our Pharmacy, and Find Specialists Based On Your Symptoms.
            </p>
            <div class="gradient">
                <button> Learn More > </button>
            </div>
        </div>
    </div>

    <div id="services">
        <div class="div_title">
            <p>Our Services</p>
        </div>
        <div class="services_path">
            <div class="red_path">
                <img src="icons/pathline.png">
            </div>
            <div class="circles">
                <div class="booking_service">
                    <div class="booking_logo">
                        <img src="icons/booking icon.png" alt="booking">
                    </div>
                    <p class="service_title">
                        Online Booking Appointments
                    </p>
                    <p class="service_text">
                        Patients have the convenience of booking offline appointments with doctors by selecting their preferred date and time. 
                    </p>
                </div>
                <div class="doctor_service">
                    <div class="doctor_logo">
                        <img src="icons/doctor icon.png" alt="doctor">
                    </div>
                    <p class="service_title">
                        Find Specialist Based On Symptoms
                    </p>
                    <p class="service_text">
                        Patients can input their symptoms, and the system will analyze them to suggest possible causes and recommend a specialist, ensuring they receive the most suitable care. 
                    </p>
                </div>
                <div class="medicine_service">
                    <div class="medicine_logo">
                        <img src="icons/medicine icon.png" alt="pharmacy">
                    </div>
                    <p class="service_title">
                        Online Pharmacy
                    </p>
                    <p class="service_text">
                        Patients can browse medicines, add them to the cart, and complete their purchase. After appointments, they’ll be directed to prescribed medications for convenience.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="about_us">
        <div class="dots1">
            <img src="icons/dots.png">
        </div>
        <div class="dots2">
            <img src="icons/dots.png">
        </div>
        <div class="div_title">
            <p>About Us</p>
        </div>
        <div class="about_us_1">
            <div class="clinic_au">
                <div class="clinic_logo">
                    <img src="icons/clinic icon.png" alt="clinic">
                </div>
                <p class="au_number">
                    17
                </p>
                <p class="au_name">
                    CLINICS
                </p>
            </div>
            <div class="lab_au">
                <div class="lab_logo">
                    <img src="icons/lab icon.png" alt="lab">
                </div>
                <p class="au_number">
                    9
                </p>
                <p class="au_name">
                    LABS
                </p>
            </div>
            <div class="pharmacy_au">
                <div class="pharmacy_logo">
                    <img src="icons/pharmacy icon.png" alt="pharmacy">
                </div>
                <p class="au_number">
                    26
                </p>
                <p class="au_name">
                    PHARMACIES
                </p>
            </div>
        </div>
        <div class="about_us_2">
            <div class="office_au">
                <div class="office_logo">
                    <img src="icons/office icon.png" alt="office">
                </div>
                <p class="au_number">
                    7
                </p>
                <p class="au_name">
                    OFFICES
                </p>
            </div>
            <div class="partner_au">
                <div class="partner_logo">
                    <img src="icons/partner icon.png" alt="lab">
                </div>
                <p class="au_number">
                    1.200
                </p>
                <p class="au_name">
                    PARTNERS
                </p>
            </div>
            <div class="optic_au">
                <div class="optic_logo">
                    <img src="icons/optic icon.png" alt="pharmacy">
                </div>
                <p class="au_number">
                    10
                </p>
                <p class="au_name">
                    OPTICS
                </p>
            </div>
        </div>
        <div class="about_us_text">
            <p>TelkoMedika operates 17 clinics, 26 pharmacies, 9 laboratories, and 10 optical centers, supported by 1,200 partner providers across Indonesia. Its offices span seven regions, including Sumatra, Jakarta, Java, Bali Nusa Tenggara, Kalimantan, and Eastern Indonesia.</p>
        </div>
    </div>

    <div class="doctors">
        <div class="div_title">
            <p>Our Doctors</p>
        </div>
        <div class="doctor_profile">
            <div class="doctor1">
                <div class="doctorpic">
                    <img src="images/maylabrebes.png">
                </div>
                <p class="doctor_name">
                    MAYLA BREBES, M. D.
                </p>
                <hr>
                <p class="doctor_specialist">
                    General Practitioner
                </p>
            </div>
            <div class="doctor2">
                <div class="doctorpic">
                    <img src="images/jamal.png">
                </div>
                <p class="doctor_name">
                    JAMAL CILACAP, M. D.
                </p>
                <hr>
                <p class="doctor_specialist">
                    Family Physician
                </p>
            </div>
            <div class="doctor3">
                <div class="doctorpic">
                    <img src="images/fariz.png">
                </div>
                <p class="doctor_name">
                    FARIZ CIPULARANG, Ph.D
                </p>
                <hr>
                <p class="doctor_specialist">
                    Orthodontics 
                </p>
            </div>
        </div>

        <div class="doctor_button">
            <a href="{{ url('doctors') }}">
                <button>
                    See All Doctors
                </button>
            </a>
        </div>
    </div>

    <footer>
        <img src="icons/logo.png" alt="telkomedika">
        <div class="footer_text">
            <div class="book_footer">
                <h1>Book Now</h1>
                <hr>
                <div class="footer_opt">
                    <a href="{{ url('appointments') }}">Book Appointment</a>
                </div>
            </div>
            <div class="discover_footer">
                <h1>Discover Us</h1>
                <hr>
                <div class="footer_opt">
                    <a href="#services">Services</a>
                    <a href="#about_us">About Us</a>
                    <a href="{{ url('doctors') }}" >Our Doctors</a>
                </div>
            </div>
            <div class="contact_footer">
                <h1>Contact Us</h1>
                <hr>
                <div class="footer_opt">
                  <a href="tel:1500115">1500115</a>
                  <a href="mailto:cs@telkomedika.co.id">cs@telkomedika.co.id</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html> -->