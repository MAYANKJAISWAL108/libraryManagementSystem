<?php
include '../include/bootstrap.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Literature Oasis</title>
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
        
        .service-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
            border: none;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .service-icon {
            font-size: 3rem;
            color: #3498db;
            margin-bottom: 1rem;
        }
        
        .card-title {
            color: #2c3e50;
            font-weight: 600;
        }
        
        .card-text {
            color: #666;
            line-height: 1.6;
        }
        
        .tab-content {
            padding: 2rem 0;
        }
        
        .nav-pills .nav-link {
            color: #2c3e50;
            font-weight: 500;
            border-radius: 5px;
            margin: 0.5rem 0;
            padding: 0.8rem 1.5rem;
        }
        
        .nav-pills .nav-link.active {
            background-color: #0c2e44ff ;
            color: white;
        }
        
        .nav-pills .nav-link:hover:not(.active) {
            background-color: rgba(52, 108, 219, 0.1);
        }
        
        .service-feature {
            margin-bottom: 1.5rem;
        }
        
        .service-feature i {
            color: #3498db;
            margin-right: 10px;
        }
    </style>
</head>
<body style="background-color: rgba(248, 249, 250, 0.9);">
       
<!--Navbar-->
<?php include '../include/navbar.php'; ?>

<!--Hero-Section-->
<div class="hero">
    <div class="sub-hero">
        <h1 style="font-size: 3.5rem;">Our Services</h1>
        <p class="lead">Discover all the ways we can support your journey</p>
    </div>
</div>

<!-- Services Overview -->
<div class="container py-5">
    <h1 class="heading">Comprehensive Library Services</h1>
    <p class="text-center mb-5">At Literature Oasis, we offer a wide range of services designed to meet the diverse needs of our community. From traditional book lending to cutting-edge technology access, we're here to support your learning and growth.</p>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 py-3">
        <div class="col">
            <div class="service-card card h-100 text-center">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h5 class="card-title">Book Lending</h5>
                    <p class="card-text">Access our vast collection of physical and digital books for all ages and interests.</p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="service-card card h-100 text-center">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h5 class="card-title">Digital Resources</h5>
                    <p class="card-text">eBooks, audiobooks, online databases, and research tools available 24/7.</p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="service-card card h-100 text-center">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="card-title">Community Programs</h5>
                    <p class="card-text">Workshops, author talks, book clubs, and educational events for all ages.</p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="service-card card h-100 text-center">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h5 class="card-title">Learning Support</h5>
                    <p class="card-text">Tutoring, research assistance, and technology training from our expert staff.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Services -->
<div class="container py-5">
    <h1 class="heading">Explore Our Services</h1>
    
    <div class="row py-5">
        <div class="col-lg-4">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-borrowing-tab" data-bs-toggle="pill" data-bs-target="#v-pills-borrowing" type="button" role="tab" aria-controls="v-pills-borrowing" aria-selected="true">Borrowing Services</button>
                <button class="nav-link" id="v-pills-digital-tab" data-bs-toggle="pill" data-bs-target="#v-pills-digital" type="button" role="tab" aria-controls="v-pills-digital" aria-selected="false">Digital Resources</button>
                <button class="nav-link" id="v-pills-research-tab" data-bs-toggle="pill" data-bs-target="#v-pills-research" type="button" role="tab" aria-controls="v-pills-research" aria-selected="false">Research Support</button>
                <button class="nav-link" id="v-pills-community-tab" data-bs-toggle="pill" data-bs-target="#v-pills-community" type="button" role="tab" aria-controls="v-pills-community" aria-selected="false">Community Programs</button>
                <button class="nav-link" id="v-pills-technology-tab" data-bs-toggle="pill" data-bs-target="#v-pills-technology" type="button" role="tab" aria-controls="v-pills-technology" aria-selected="false">Technology Access</button>
                <button class="nav-link" id="v-pills-special-tab" data-bs-toggle="pill" data-bs-target="#v-pills-special" type="button" role="tab" aria-controls="v-pills-special" aria-selected="false">Special Collections</button>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-borrowing" role="tabpanel" aria-labelledby="v-pills-borrowing-tab">
                    <h3>Borrowing Services</h3>
                    <p>Access our extensive collection of materials with flexible borrowing options tailored to your needs.</p>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Book Loans</h5>
                        <p>Borrow up to 15 items for 3 weeks with options to renew online or in person.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Interlibrary Loans</h5>
                        <p>Can't find what you need? We'll borrow it from another library system at no cost to you.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Hold Services</h5>
                        <p>Reserve popular items and get notified when they're available for pickup.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Book Delivery</h5>
                        <p>Homebound? We offer delivery services for patrons with mobility challenges.</p>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="v-pills-digital" role="tabpanel" aria-labelledby="v-pills-digital-tab">
                    <h3>Digital Resources</h3>
                    <p>Access a world of information from anywhere with our comprehensive digital collection.</p>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> eBooks & Audiobooks</h5>
                        <p>Borrow from over 50,000 digital titles through Libby and OverDrive platforms.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Online Databases</h5>
                        <p>Access scholarly journals, newspapers, and specialized databases with your library card.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Digital Magazines</h5>
                        <p>Read current issues of popular magazines through our Flipster service.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Streaming Media</h5>
                        <p>Enjoy educational videos, documentaries, and language learning resources.</p>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="v-pills-research" role="tabpanel" aria-labelledby="v-pills-research-tab">
                    <h3>Research Support</h3>
                    <p>Get expert help with your research projects from our knowledgeable staff.</p>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Research Assistance</h5>
                        <p>One-on-one help with finding resources and navigating databases.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Citation Help</h5>
                        <p>Get support with formatting citations in APA, MLA, Chicago, and other styles.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Database Training</h5>
                        <p>Learn how to effectively use specialized databases for academic and personal research.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> School Assignments</h5>
                        <p>Specialized help for K-12 students with school projects and homework.</p>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="v-pills-community" role="tabpanel" aria-labelledby="v-pills-community-tab">
                    <h3>Community Programs</h3>
                    <p>Join our vibrant community of learners through our diverse programming offerings.</p>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Children's Storytime</h5>
                        <p>Weekly interactive reading sessions for different age groups to foster early literacy.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Author Events</h5>
                        <p>Meet acclaimed authors through our talks, readings, and book signings.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Book Clubs</h5>
                        <p>Join one of our genre-specific book clubs for engaging discussions.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Workshops & Classes</h5>
                        <p>Learn new skills through our technology, writing, and creative workshops.</p>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="v-pills-technology" role="tabpanel" aria-labelledby="v-pills-technology-tab">
                    <h3>Technology Access</h3>
                    <p>Bridge the digital divide with our technology resources and training programs.</p>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Public Computers</h5>
                        <p>Access high-speed internet and productivity software on our public workstations.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Wi-Fi Access</h5>
                        <p>Free high-speed Wi-Fi throughout the library building and 24/7 access in our parking lot.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Printing & Scanning</h5>
                        <p>Affordable printing, scanning, and photocopying services available.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Tech Help</h5>
                        <p>One-on-one assistance with devices, software, and digital literacy skills.</p>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="v-pills-special" role="tabpanel" aria-labelledby="v-pills-special-tab">
                    <h3>Special Collections</h3>
                    <p>Explore our unique specialized collections not available elsewhere.</p>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Local History Archive</h5>
                        <p>Access historical documents, photographs, and records of our community.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Genealogy Resources</h5>
                        <p>Research your family history with access to ancestry databases and historical records.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Rare Books Collection</h5>
                        <p>View our carefully preserved rare books and special editions by appointment.</p>
                    </div>
                    
                    <div class="service-feature">
                        <h5><i class="fas fa-check-circle"></i> Multilingual Collection</h5>
                        <p>Books, magazines, and media in over 15 languages for our diverse community.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Membership Info -->
<div class="container py-5">
    <h1 class="heading">Become a Member</h1>
    
    <div class="row align-items-center py-5">
        <div class="col-md-6">
            <h3>Getting a Library Card</h3>
            <p>Joining Literature Oasis is easy and free for all community residents. Your library card gives you access to all our physical and digital resources.</p>
            
            <div class="service-feature">
                <h5><i class="fas fa-user-plus"></i> Eligibility</h5>
                <p>Any resident of our service area can get a free library card with proof of address.</p>
            </div>
            
            <div class="service-feature">
                <h5><i class="fas fa-id-card"></i> Application Process</h5>
                <p>Apply in person at any service desk or start your application online and complete it at the library.</p>
            </div>
            
            <div class="service-feature">
                <h5><i class="fas fa-child"></i> Youth Cards</h5>
                <p>Children under 14 can get a library card with a parent or guardian's signature.</p>
            </div>
            
            <div class="service-feature">
                <h5><i class="fas fa-building"></i> Institutional Cards</h5>
                <p>Schools and nonprofit organizations can apply for special institutional membership.</p>
            </div>
            
            <a href="#" class="btn btn-primary mt-3">Apply for a Library Card</a>
        </div>
        
        <div class="col-md-6">
            <img src="https://images.pexels.com/photos/6609533/pexels-photo-6609533.jpeg" 
                 alt="Library Card" class="img-fluid rounded shadow">
        </div>
    </div>
</div>

<!--Footer-->
<?php include '../include/footer.php'; ?>

</body>
</html>