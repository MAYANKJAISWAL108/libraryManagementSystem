<?php
include '../include/bootstrap.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Literature Oasis</title>
    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg') no-repeat center center;
            background-size: cover;
            height: 80vh;
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
        
        .testimonial-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-title {
            color: #2c3e50;
            font-weight: 600;
        }
        
        .card-text {
            color: #666;
            line-height: 1.6;
        }
        
        .stars {
            color: #FFD43B;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body style="background-color: rgba(248, 249, 250, 0.9);">
       
<!--Navbar-->
  <?php   include '../include/navbar.php'; ?>

<!--Hero-Section-->
<div class="hero">
    <div class="sub-hero">
        <h1 style="font-size: 4rem;">About Literature Oasis</h1>
        <p class="lead">Where knowledge meets community</p>
    </div>
</div>

<!-- Our Journey -->
<div class="container py-5">
    <h1 class="heading">Our Journey: From Small Collection to Community Hub</h1>
    <div class="row align-items-center">
        <div class="col-md-6 py-4">
            <img src="https://images.pexels.com/photos/7516383/pexels-photo-7516383.jpeg" 
                 alt="Library History" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2 class="text-center">How It Started</h2>
            <p class="oj">
                In 1995, Literature Oasis began as a small community initiative with just 500 donated books. What started in a modest storefront has grown into a cornerstone of our community. Our founders believed that access to knowledge should be available to everyone, regardless of background or means. Those early days of handwritten catalog cards and volunteer staff laid the foundation for what would become a thriving educational hub.
            </p>
        </div>
    </div>

    <div class="row align-items-center py-5">
        <div class="col-md-6 order-md-2 py-4">
            <img src="https://images.pexels.com/photos/9304669/pexels-photo-9304669.jpeg" 
                 alt="Digital Transformation" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6 order-md-1">
            <h2 class="text-center">The Digital Transformation</h2>
            <p class="oj">
                In 2010, we embarked on an ambitious digitization project that would transform how our community accesses information. We introduced our first online catalog, digital lending services, and computer workstations. This expansion allowed us to serve not just local patrons but also remote users. Our eBook collection grew from zero to over 20,000 titles in just five years, making knowledge accessible to everyone with an internet connection.
            </p>
        </div>
    </div>

    <div class="row align-items-center py-5">
        <div class="col-md-6 py-4">
            <img src="https://images.pexels.com/photos/8199245/pexels-photo-8199245.jpeg" 
                 alt="Community Space" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2 class="text-center">Becoming a Community Center</h2>
            <p class="oj">
                By 2018, we had evolved beyond just books. We transformed our space to include collaborative work areas, study rooms, community meeting spaces, and technology labs. Our programming expanded to include literacy programs, author talks, technology training, and cultural events. We became not just a repository of books but a vibrant community center where people connect, learn, and grow together.
            </p>
        </div>
    </div>

    <div class="row align-items-center py-5">
        <div class="col-md-6 order-md-2 py-4">
            <img src="https://images.pexels.com/photos/6981103/pexels-photo-6981103.jpeg" 
                 alt="Future Vision" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6 order-md-1">
            <h2 class="text-center" >The Future: Where We're Headed</h2>
            <p class="oj">
                Today, we're pioneering the library of the future. With plans for augmented reality learning experiences, maker spaces with 3D printers, and AI-assisted research tools, we're continuously evolving to meet our community's changing needs. Our upcoming initiatives include a digital literacy program for seniors, a teen technology incubator, and expanded access to specialized databases. The library remains committed to its core mission: empowering our community through knowledge, connection, and opportunity.
            </p>
        </div>
    </div>
</div>

<!--Testimonials-->
<div class="container py-5">
    <h1 class="heading">What Our Community Says!</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
        <div class="col">
            <div class="testimonial-card h-100">
                <div class="card-body text-center">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" 
                         class="rounded-circle mb-3" alt="Student" style="width: 100px; height: 100px; object-fit: cover;">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="card-title">– Sarah M., College Student</h5>
                    <p class="card-text">"The library's quiet study areas and extensive research databases have been invaluable throughout my degree. The staff helped me navigate complex academic resources I wouldn't have found on my own."</p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="testimonial-card h-100">
                <div class="card-body text-center">
                    <img src="https://images.pexels.com/photos/33592743/pexels-photo-33592743.jpeg" 
                         class="rounded-circle mb-3" alt="Parent" style="width: 100px; height: 100px; object-fit: cover;">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="card-title">– James T., Parent</h5>
                    <p class="card-text">"The children's reading programs have ignited my kids' love for books. The summer reading challenge especially keeps them engaged and learning when school's out. We visit at least twice a week!"</p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="testimonial-card h-100">
                <div class="card-body text-center">
                    <img src="https://images.unsplash.com/photo-1552058544-f2b08422138a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" 
                         class="rounded-circle mb-3" alt="Researcher" style="width: 100px; height: 100px; object-fit: cover;">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="card-title">– Dr. Emily R., Local Researcher</h5>
                    <p class="card-text">"The library's access to academic journals and specialized databases has been crucial for my work. The librarians' expertise in research methodology has saved me countless hours of searching."</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer-->
  <?php   include '../include/footer.php'; ?>


</body>
</html>