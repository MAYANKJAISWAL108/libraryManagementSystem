<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Footer</title>

    <style>
        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #1a2530 100%);
            color: white;
            padding: 4rem 0 0;
        }
        
        .footer-top {
            padding-bottom: 3rem;
        }
        
        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
        }
        
        .footer-description {
            color: #bdc3c7;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .footer-heading {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: #3498db;
            border-radius: 2px;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        
        .footer-links a:hover {
            color: #3498db;
            transform: translateX(5px);
        }
        
        .footer-links a i {
            margin-right: 10px;
            font-size: 0.9rem;
        }
        
        .footer-contact-info {
            color: #bdc3c7;
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        
        .footer-contact-info i {
            margin-right: 15px;
            color: #3498db;
            font-size: 1.1rem;
            margin-top: 4px;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 1.5rem;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            background: #3498db;
            transform: translateY(-3px);
        }
        
        .newsletter-form {
            display: flex;
            margin-top: 1.5rem;
        }
        
        .newsletter-input {
            flex-grow: 1;
            padding: 12px 15px;
            border: none;
            border-radius: 4px 0 0 4px;
            outline: none;
        }
        
        .newsletter-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .newsletter-btn:hover {
            background: #2980b9;
        }
        
        .footer-bottom {
            background: rgba(0, 0, 0, 0.2);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }
        
        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .copyright {
            color: #bdc3c7;
            margin: 0;
        }
        
        .footer-bottom-links {
            display: flex;
            gap: 20px;
        }
        
        .footer-bottom-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .footer-bottom-links a:hover {
            color: #3498db;
        }
        
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #3498db;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background: #2980b9;
            transform: translateY(-5px);
        }
        
        @media (max-width: 992px) {
            .footer-col {
                margin-bottom: 2rem;
            }
            
            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            .footer-bottom-links {
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-input {
                border-radius: 4px;
                margin-bottom: 10px;
            }
            
            .newsletter-btn {
                border-radius: 4px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>

<footer class="footer">
    <div class="container">
        <div class="row footer-top">
            <div class="col-lg-4 col-md-6 footer-col">
                <img src="https://img.freepik.com/premium-vector/bookish-oasis-student-sitting-books-emblem-literary-retreat-student-chair-with-books-logo_706143-96993.jpg" alt="img" height="150" width="160" >
                <div class="footer-logo">Literature Oasis</div>
                <p class="footer-description">
                    Your gateway to knowledge, community, and endless discovery. 
                    We provide resources and spaces that inspire learning and connection.
                </p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 footer-col">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Collections</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Events</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Blog</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6 footer-col">
                <h4 class="footer-heading">Resources</h4>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Research Databases</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> E-books</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Audiobooks</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Online Courses</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Digital Archives</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6 footer-col">
                <h4 class="footer-heading">Contact Info</h4>
                <div class="footer-contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>123 Library Lane, Knowledge City, KC 12345</div>
                </div>
                <div class="footer-contact-info">
                    <i class="fas fa-phone"></i>
                    <div>+1 (555) 123-4567</div>
                </div>
                <div class="footer-contact-info">
                    <i class="fas fa-envelope"></i>
                    <div>info@literatureoasis.com</div>
                </div>
                
                <h4 class="footer-heading" style="margin-top: 1.5rem;">Newsletter</h4>
                <p style="color: #bdc3c7; margin-bottom: 1rem;">Subscribe to our newsletter for updates</p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Your email address">
                    <button type="submit" class="newsletter-btn"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p class="copyright">© 2025 Literature Oasis. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Accessibility</a>
                </div>
            </div>
        </div>
    </div>
    
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>
</footer>

<script>
    // Back to top button functionality
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });
    
    backToTopButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
</body>
</html>