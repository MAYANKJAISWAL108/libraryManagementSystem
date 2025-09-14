<?php
include '../include/bootstrap.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Literature Oasis</title>
    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('https://images.pexels.com/photos/1370298/pexels-photo-1370298.jpeg') no-repeat center center;
            background-size: cover;
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .hero h1,
.hero p {
    animation: fadeInUp 1s ease-in-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

        .heading {
            font-family: 'Georgia', serif;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .heading:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: #db3434;
            border-radius: 2px;
        }

        .oj {
            text-align: justify;
            line-height: 1.8;
            color: #555;
            font-size: 1.1rem;
        }

        .contact-info-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
            border: none;
            padding: 1.5rem;
        }

        .contact-info-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 2rem;
            color: #3498db;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.25rem rgba(52, 122, 219, 0.25);
        }

        .btn-primary {
            background-color: #3498db;
        }

        .btn-primary:hover {
            background-color: #10067a;
        }

        .info-item {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
            position: relative;
        }

        .info-item i {
            position: absolute;
            left: 0;
            top: 0.3rem;
            color: #3498db;
            font-size: 1.2rem;
        }
    </style>
</head>

<body style="background-color: rgba(248, 249, 250, 0.9);">

    <!--Navbar-->
    <?php include '../include/navbar.php'; ?>

    <!--Hero-Section-->
    <div class="hero">
        <div class="sub-hero">
            <h1 style="font-size: 3.5rem;">Contact Us</h1>
            <p class="lead">We're here to help with all your literary needs</p>
        </div>
    </div>

    <!-- Introduction -->
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="https://images.pexels.com/photos/6609468/pexels-photo-6609468.jpeg" alt="Library Help Desk"
                    class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">Your Questions, Suggestions, and Feedback Matter</h2>
                <p class="oj">
                    At Literature Oasis, we believe that communication is key to serving our community effectively.
                    Whether you have a question about our services, need research assistance, want to suggest new
                    materials, or have feedback to help us improve, we're all ears.
                </p>
                <p class="oj">
                    Our dedicated team is committed to responding to all inquiries within 24-48 hours. For immediate
                    assistance with your account or research questions, we recommend calling during our regular business
                    hours.
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Form & Information -->
    <div class="container py-5">
        <h1 class="heading">Get In Touch</h1>

        <div class="row py-5">
            <!-- Contact Form -->
            <div class="col-lg-7 mb-5">
                <div class="contact-info-card">
                    <h3 class="mb-4">Send Us a Message</h3>
                    <form action="#" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <select class="form-select" id="subject" name="subject" required>
                                <option value="" selected disabled>Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="research">Research Assistance</option>
                                <option value="suggestion">Book Suggestion</option>
                                <option value="account">Account Issue</option>
                                <option value="event">Event Information</option>
                                <option value="donation">Book Donation</option>
                                <option value="volunteer">Volunteering</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-5">
                <div class="contact-info-card mb-4">
                    <h3 class="mb-4">Contact Information</h3>

                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Address</h5>
                        <p>123 Knowledge Avenue<br>Literary District, BK 12345</p>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        <h5>Phone Numbers</h5>
                        <p>Main: (555) 123-READ (7323)<br>Reference Desk: (555) 123-REFERENCE (7333)<br>Children's
                            Department: (555) 123-KIDS (5437)</p>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <h5>Email Addresses</h5>
                        <p>General Inquiries: info@literatureoasis.org<br>Reference Questions:
                            reference@literatureoasis.org<br>Children's Programs: children@literatureoasis.org</p>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <h5>Opening Hours</h5>
                        <p>Monday-Thursday: 9:00 AM - 9:00 PM<br>Friday-Saturday: 9:00 AM - 6:00 PM<br>Sunday: 12:00 PM
                            - 6:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Map -->
    <div class="container mb-4">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3682.8675410450624!2d88.45679627467467!3d22.62142103118037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89f76e15dc313%3A0xec6b9708da8c3d5f!2sTravarsa%20Technology%20(TechCapita%20Technology)!5e0!3m2!1sen!2sin!4v1756630973294!5m2!1sen!2sin"
            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>


    <!-- Department Contacts -->
    <div class="container py-5">
        <h1 class="heading">Department Contacts</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 py-5">
            <div class="col">
                <div class="contact-info-card text-center h-100">
                    <div class="contact-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h5>Circulation Desk</h5>
                    <p>For book checkouts, returns, and account questions</p>
                    <p><strong>Email:</strong> circulation@literatureoasis.org</p>
                    <p><strong>Ext:</strong> 101</p>
                </div>
            </div>

            <div class="col">
                <div class="contact-info-card text-center h-100">
                    <div class="contact-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h5>Reference Desk</h5>
                    <p>Research assistance and database support</p>
                    <p><strong>Email:</strong> reference@literatureoasis.org</p>
                    <p><strong>Ext:</strong> 102</p>
                </div>
            </div>

            <div class="col">
                <div class="contact-info-card text-center h-100">
                    <div class="contact-icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <h5>Children's Department</h5>
                    <p>Programs and services for young readers</p>
                    <p><strong>Email:</strong> children@literatureoasis.org</p>
                    <p><strong>Ext:</strong> 103</p>
                </div>
            </div>

            <div class="col">
                <div class="contact-info-card text-center h-100">
                    <div class="contact-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h5>Technology Help</h5>
                    <p>Computer, printing, and digital resource assistance</p>
                    <p><strong>Email:</strong> techhelp@literatureoasis.org</p>
                    <p><strong>Ext:</strong> 104</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container py-5">
        <h1 class="heading">Frequently Asked Questions</h1>

        <div class="accordion py-5" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        How do I get a library card?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can apply for a library card in person at any service desk with a valid ID and proof of
                        address. Alternatively, you can start your application online through our website and complete
                        it at the library.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq2">
                        How many items can I borrow at once?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Regular patrons can borrow up to 15 items at once, including books, audiobooks, and DVDs. There
                        may be additional limits on certain high-demand items.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq3">
                        How do I renew my borrowed items?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can renew items through your online account on our website, via our mobile app, by calling
                        the circulation desk at (555) 123-7323, or in person at any service desk. Most items can be
                        renewed up to two times if there are no holds on them.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq4">
                        Do you offer home delivery service?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, we offer free home delivery for patrons who are homebound due to age, illness, or
                        disability. Please contact our outreach department at outreach@literatureoasis.org or call
                        extension 105 to learn more and register for this service.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq5">
                        How can I donate books to the library?
                    </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We accept book donations during regular business hours at the main circulation desk. Please
                        review our donation guidelines on our website before bringing items. We typically accept gently
                        used books published within the last 5 years, though exceptions are made for classics and local
                        history materials.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php include '../include/footer.php'; ?>

</body>

</html>