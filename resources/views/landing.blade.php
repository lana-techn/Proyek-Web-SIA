<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Barang - Sistem Manajemen Inventaris Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --green: #10b981;
            --green-light: #34d399;
            --yellow: #f59e0b;
            --purple: #8b5cf6;
            --red: #ef4444;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--gray-50);
            color: var(--dark);
            line-height: 1.7;
            overflow-x: hidden;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Enhanced Navbar */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 12px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 8px 0;
        }
        
        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--dark) !important;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.5px;
        }
        
        .navbar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav-link-custom {
            color: var(--gray-600) !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 10px 16px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        
        .nav-link-custom:hover {
            color: var(--primary) !important;
            background-color: var(--gray-100);
        }
        
        .nav-divider {
            width: 1px;
            height: 24px;
            background-color: var(--gray-200);
            margin: 0 8px;
        }
        
        .btn-login {
            background-color: var(--dark);
            color: white !important;
            padding: 10px 20px !important;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-login:hover {
            background-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }
        
        /* Hero Section */
        .hero-section {
            padding: 180px 0 120px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: white;
            border: 1px solid var(--gray-200);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .hero-badge i {
            color: var(--green);
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 24px;
            line-height: 1.15;
            letter-spacing: -1.5px;
        }
        
        .hero-title .highlight {
            color: var(--primary);
            position: relative;
        }

        .hero-title .highlight::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 0;
            right: 0;
            height: 12px;
            background-color: rgba(59, 130, 246, 0.15);
            z-index: -1;
            border-radius: 4px;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--gray-500);
            max-width: 540px;
            margin-bottom: 40px;
            line-height: 1.8;
        }
        
        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 60px;
        }
        
        .btn-primary-custom {
            background-color: var(--primary);
            color: white;
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
        }
        
        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.35);
        }
        
        .btn-secondary-custom {
            background-color: white;
            color: var(--dark);
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: 2px solid var(--gray-200);
        }
        
        .btn-secondary-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        /* Hero Stats */
        .hero-stats {
            display: flex;
            gap: 48px;
            flex-wrap: wrap;
        }

        .hero-stat {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hero-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .hero-stat-icon.blue { background-color: #dbeafe; color: var(--primary); }
        .hero-stat-icon.green { background-color: #d1fae5; color: var(--green); }
        .hero-stat-icon.yellow { background-color: #fef3c7; color: var(--yellow); }

        .hero-stat-text h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .hero-stat-text p {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin: 0;
        }

        /* Hero Image */
        .hero-image-wrapper {
            position: relative;
        }

        .hero-image {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            padding: 24px;
            border: 1px solid var(--gray-200);
        }

        .hero-image-header {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .hero-image-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .hero-image-dot.red { background-color: #ef4444; }
        .hero-image-dot.yellow { background-color: #f59e0b; }
        .hero-image-dot.green { background-color: #10b981; }

        .hero-image-content {
            background-color: var(--gray-50);
            border-radius: 12px;
            padding: 20px;
        }

        .hero-mock-row {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
        }

        .hero-mock-row:last-child {
            margin-bottom: 0;
        }

        .hero-mock-item {
            height: 40px;
            border-radius: 8px;
            flex: 1;
        }

        .hero-mock-item.blue { background-color: #dbeafe; }
        .hero-mock-item.green { background-color: #d1fae5; }
        .hero-mock-item.yellow { background-color: #fef3c7; }
        .hero-mock-item.purple { background-color: #ede9fe; }

        .floating-card {
            position: absolute;
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .floating-card.top-left {
            top: -20px;
            left: -40px;
        }

        .floating-card.bottom-right {
            bottom: 20px;
            right: -30px;
        }

        .floating-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .floating-icon.green { background-color: #d1fae5; color: var(--green); }
        .floating-icon.blue { background-color: #dbeafe; color: var(--primary); }

        .floating-text h5 {
            font-size: 0.9rem;
            font-weight: 700;
            margin: 0;
            color: var(--dark);
        }

        .floating-text p {
            font-size: 0.8rem;
            margin: 0;
            color: var(--gray-500);
        }
        
        /* Features Section */
        .features-section {
            padding: 100px 0;
            background-color: white;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--gray-100);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 16px;
            color: var(--dark);
            letter-spacing: -1px;
        }
        
        .section-subtitle {
            color: var(--gray-500);
            max-width: 500px;
            margin: 0 auto;
            font-size: 1.1rem;
        }
        
        .feature-card {
            background-color: var(--gray-50);
            border-radius: 20px;
            padding: 36px;
            height: 100%;
            border: 1px solid var(--gray-200);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background-color: transparent;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: transparent;
        }

        .feature-card:hover::before {
            background-color: var(--primary);
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 24px;
        }
        
        .feature-icon.blue { background-color: #dbeafe; color: var(--primary); }
        .feature-icon.green { background-color: #d1fae5; color: var(--green); }
        .feature-icon.yellow { background-color: #fef3c7; color: var(--yellow); }
        .feature-icon.purple { background-color: #ede9fe; color: var(--purple); }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--dark);
        }
        
        .feature-desc {
            color: var(--gray-500);
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: var(--gray-600);
            margin-bottom: 10px;
        }

        .feature-list li:last-child {
            margin-bottom: 0;
        }

        .feature-list li i {
            color: var(--green);
            font-size: 0.85rem;
        }

        /* How It Works */
        .how-section {
            padding: 100px 0;
            background-color: var(--gray-50);
        }

        .step-card {
            text-align: center;
            padding: 32px 24px;
        }

        .step-number {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background-color: var(--primary);
            color: white;
            font-size: 1.3rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.25);
        }

        .step-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .step-desc {
            color: var(--gray-500);
            font-size: 0.95rem;
        }

        .step-connector {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .step-connector i {
            font-size: 2rem;
            color: var(--gray-300);
        }
        
        /* Stats Section */
        .stats-section {
            padding: 80px 0;
            background-color: var(--dark);
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .stat-item {
            text-align: center;
            padding: 32px;
            position: relative;
            z-index: 1;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .stat-number span {
            color: var(--primary-light);
        }
        
        .stat-label {
            color: var(--gray-400);
            font-weight: 500;
            font-size: 1rem;
        }

        /* Testimonial Section */
        .testimonial-section {
            padding: 100px 0;
            background-color: white;
        }

        .testimonial-card {
            background-color: var(--gray-50);
            border-radius: 20px;
            padding: 32px;
            border: 1px solid var(--gray-200);
            height: 100%;
        }

        .testimonial-quote {
            font-size: 1.1rem;
            color: var(--gray-700);
            line-height: 1.8;
            margin-bottom: 24px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .testimonial-avatar {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .testimonial-info h5 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 4px;
            color: var(--dark);
        }

        .testimonial-info p {
            font-size: 0.85rem;
            margin: 0;
            color: var(--gray-500);
        }

        .testimonial-rating {
            margin-top: 16px;
            color: var(--yellow);
        }
        
        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background-color: var(--gray-50);
        }

        .cta-card {
            background-color: var(--dark);
            border-radius: 24px;
            padding: 64px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-card::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        .cta-card::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        
        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
            letter-spacing: -1px;
        }
        
        .cta-subtitle {
            color: var(--gray-400);
            margin-bottom: 40px;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .btn-cta {
            background-color: white;
            color: var(--dark);
            padding: 18px 40px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.05rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        
        .btn-cta:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(255, 255, 255, 0.15);
            color: var(--primary);
        }
        
        /* Footer */
        .footer {
            background-color: white;
            padding: 48px 0;
            border-top: 1px solid var(--gray-200);
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .footer-brand .brand-icon {
            width: 36px;
            height: 36px;
            background-color: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.95rem;
        }
        
        .footer-text {
            color: var(--gray-500);
            font-size: 0.9rem;
        }

        .footer-links {
            display: flex;
            gap: 24px;
        }

        .footer-links a {
            color: var(--gray-500);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: var(--primary);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-section {
                padding: 140px 0 80px;
            }
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-image-wrapper {
                margin-top: 60px;
            }
            .floating-card {
                display: none;
            }
            .step-connector {
                display: none;
            }
            .cta-card {
                padding: 48px 24px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .hero-stats {
                gap: 24px;
            }
            .section-title {
                font-size: 1.8rem;
            }
            .stat-number {
                font-size: 2.2rem;
            }
            .nav-links .nav-link-custom {
                display: none;
            }
            .nav-divider {
                display: none;
            }
            .cta-title {
                font-size: 1.8rem;
            }
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
        }

        /* Chart Tabs */
        .chart-tabs {
            display: flex;
            gap: 8px;
        }

        .chart-tab {
            flex: 1;
            padding: 10px 16px;
            border: none;
            background-color: var(--gray-100);
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .chart-tab:hover {
            background-color: var(--gray-200);
        }

        .chart-tab.active {
            background-color: var(--primary);
            color: white;
        }

        .chart-container {
            min-height: 180px;
        }

        /* About Project Section */
        .about-project-section {
            padding: 80px 0;
            background-color: white;
        }

        .about-project-card {
            background-color: var(--gray-50);
            border-radius: 24px;
            padding: 48px;
            border: 1px solid var(--gray-200);
            border-left: 4px solid var(--primary);
        }

        .student-avatar {
            font-size: 8rem;
            color: var(--primary);
            line-height: 1;
        }

        .github-avatar {
            width: 160px;
            height: 160px;
            border-radius: 20px;
            object-fit: cover;
            border: 4px solid var(--primary);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }

        .github-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.3);
        }

        .github-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .github-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .about-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .about-nim {
            font-size: 1.1rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 24px;
        }

        .about-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .about-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1rem;
            color: var(--gray-600);
        }

        .about-item i {
            font-size: 1.2rem;
            color: var(--primary);
            width: 24px;
        }

        @media (max-width: 768px) {
            .about-project-card {
                padding: 32px 24px;
            }
            .student-avatar {
                font-size: 5rem;
            }
            .about-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-custom" id="navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="/">
                    <div class="brand-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    Aplikasi Barang
                </a>
                <div class="nav-links">
                    <a href="#features" class="nav-link-custom">Fitur</a>
                    <a href="#how-it-works" class="nav-link-custom">Cara Kerja</a>
                    <a href="#testimonials" class="nav-link-custom">Testimoni</a>
                    <div class="nav-divider"></div>
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class="bi bi-box-arrow-in-right"></i> 
                        <span class="d-none d-sm-inline">Login Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-right" data-aos-duration="800">
                        <div class="hero-badge">
                            <i class="bi bi-lightning-charge-fill"></i>
                            Versi 2.0 Tersedia Sekarang
                        </div>
                        <h1 class="hero-title">
                            Kelola Inventaris<br>dengan <span class="highlight">Lebih Cerdas</span>
                        </h1>
                        <p class="hero-subtitle">
                            Platform manajemen barang all-in-one untuk membantu Anda mengelola stok, transaksi, dan laporan penjualan dengan lebih efisien.
                        </p>
                        <div class="hero-buttons">
                            <a href="{{ route('login') }}" class="btn-primary-custom">
                                <i class="bi bi-rocket-takeoff-fill"></i> Mulai Sekarang
                            </a>
                            <a href="#features" class="btn-secondary-custom">
                                <i class="bi bi-play-circle"></i> Lihat Demo
                            </a>
                        </div>
                        <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                            <div class="hero-stat">
                                <div class="hero-stat-icon blue">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div class="hero-stat-text">
                                    <h4>{{ number_format($totalBarang) }}</h4>
                                    <p>Total Barang</p>
                                </div>
                            </div>
                            <div class="hero-stat">
                                <div class="hero-stat-icon green">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <div class="hero-stat-text">
                                    <h4>{{ number_format($totalTransaksi) }}</h4>
                                    <p>Transaksi</p>
                                </div>
                            </div>
                            <div class="hero-stat">
                                <div class="hero-stat-icon yellow">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                                <div class="hero-stat-text">
                                    <h4>Rp {{ number_format($totalPenjualan / 1000000, 1) }}jt</h4>
                                    <p>Penjualan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-wrapper" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                        <div class="floating-card top-left" data-aos="fade-down" data-aos-delay="600">
                            <div class="floating-icon green">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="floating-text">
                                <h5>Total Penjualan</h5>
                                <p>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="hero-image">
                            <div class="hero-image-header">
                                <div class="hero-image-dot red"></div>
                                <div class="hero-image-dot yellow"></div>
                                <div class="hero-image-dot green"></div>
                            </div>
                            <div class="hero-image-content" style="padding: 16px;">
                                <!-- Chart Tabs -->
                                <div class="chart-tabs mb-3">
                                    <button class="chart-tab active" onclick="showChart('bar')" id="tab-bar">
                                        <i class="bi bi-bar-chart-fill"></i> Barang Terlaris
                                    </button>
                                    <button class="chart-tab" onclick="showChart('doughnut')" id="tab-doughnut">
                                        <i class="bi bi-pie-chart-fill"></i> Kategori
                                    </button>
                                </div>
                                <!-- Bar Chart -->
                                <div id="chart-bar" class="chart-container">
                                    <canvas id="topProductsChart" height="180"></canvas>
                                </div>
                                <!-- Doughnut Chart -->
                                <div id="chart-doughnut" class="chart-container" style="display: none;">
                                    <canvas id="categoryChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="floating-card bottom-right" data-aos="fade-up" data-aos-delay="800">
                            <div class="floating-icon blue">
                                <i class="bi bi-bar-chart-fill"></i>
                            </div>
                            <div class="floating-text">
                                <h5>{{ $totalTransaksi }} Transaksi</h5>
                                <p>Data Realtime</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">
                    <i class="bi bi-stars"></i> Fitur Unggulan
                </div>
                <h2 class="section-title">Semua yang Anda Butuhkan</h2>
                <p class="section-subtitle">
                    Fitur lengkap untuk mengelola bisnis inventaris Anda dengan mudah
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon blue">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <h3 class="feature-title">Manajemen Barang</h3>
                        <p class="feature-desc">
                            Kelola daftar produk dengan mudah dan cepat dalam beberapa klik
                        </p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Tambah & edit barang</li>
                            <li><i class="bi bi-check-circle-fill"></i> Kategori & jenis</li>
                            <li><i class="bi bi-check-circle-fill"></i> Manajemen stok</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon green">
                            <i class="bi bi-cart-check-fill"></i>
                        </div>
                        <h3 class="feature-title">Transaksi Penjualan</h3>
                        <p class="feature-desc">
                            Catat setiap transaksi dan lacak riwayat pembelian pelanggan
                        </p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Kasir digital</li>
                            <li><i class="bi bi-check-circle-fill"></i> Cetak struk</li>
                            <li><i class="bi bi-check-circle-fill"></i> Riwayat transaksi</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon yellow">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3 class="feature-title">Laporan & Statistik</h3>
                        <p class="feature-desc">
                            Dapatkan insight bisnis dengan dashboard dan laporan lengkap
                        </p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Dashboard realtime</li>
                            <li><i class="bi bi-check-circle-fill"></i> Barang terlaris</li>
                            <li><i class="bi bi-check-circle-fill"></i> Notifikasi stok</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-section" id="how-it-works">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">
                    <i class="bi bi-lightning-charge"></i> Cara Kerja
                </div>
                <h2 class="section-title">Mulai dalam 3 Langkah</h2>
                <p class="section-subtitle">
                    Proses sederhana untuk mulai mengelola inventaris Anda
                </p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h3 class="step-title">Login ke Sistem</h3>
                        <p class="step-desc">Masuk ke dashboard admin dengan akun Anda</p>
                    </div>
                </div>
                <div class="col-lg-1 d-none d-lg-block">
                    <div class="step-connector">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h3 class="step-title">Input Data</h3>
                        <p class="step-desc">Tambahkan data barang dan atur kategori</p>
                    </div>
                </div>
                <div class="col-lg-1 d-none d-lg-block">
                    <div class="step-connector">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h3 class="step-title">Mulai Transaksi</h3>
                        <p class="step-desc">Catat penjualan dan pantau laporan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <div class="stat-number">100<span>+</span></div>
                        <div class="stat-label">Produk Terkelola</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <div class="stat-number">500<span>+</span></div>
                        <div class="stat-label">Transaksi</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item">
                        <div class="stat-number">24<span>/7</span></div>
                        <div class="stat-label">Akses Online</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-item">
                        <div class="stat-number">99<span>%</span></div>
                        <div class="stat-label">Uptime Server</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonial-section" id="testimonials">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">
                    <i class="bi bi-chat-quote"></i> Testimoni
                </div>
                <h2 class="section-title">Apa Kata Mereka</h2>
                <p class="section-subtitle">
                    Pendapat dari pengguna yang sudah menggunakan sistem ini
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <p class="testimonial-quote">
                            "Sistem yang sangat membantu dalam mengelola stok barang toko saya. Mudah digunakan dan tampilan yang modern."
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">AS</div>
                            <div class="testimonial-info">
                                <h5>Ahmad Saputra</h5>
                                <p>Pemilik Toko Elektronik</p>
                            </div>
                        </div>
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <p class="testimonial-quote">
                            "Dashboard yang informatif dan fitur cetak struk yang sangat membantu. Recommended untuk UMKM!"
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">SR</div>
                            <div class="testimonial-info">
                                <h5>Sinta Rahayu</h5>
                                <p>Owner Boutique</p>
                            </div>
                        </div>
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-card">
                        <p class="testimonial-quote">
                            "Sangat membantu untuk tracking penjualan harian. Fitur barang terlaris jadi insight berharga untuk bisnis."
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">BP</div>
                            <div class="testimonial-info">
                                <h5>Budi Pratama</h5>
                                <p>Manajer Gudang</p>
                            </div>
                        </div>
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Project Section -->
    <section class="about-project-section" id="about-project">
        <div class="container">
            <div class="about-project-card" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
                        <div class="student-avatar">
                            <a href="https://github.com/maulana-tech" target="_blank" title="View GitHub Profile">
                                <img src="https://github.com/maulana-tech.png" alt="Muhammad Maulana Firdaussyah" class="github-avatar">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="section-badge mb-3">
                            <i class="bi bi-mortarboard-fill"></i> Tugas Proyek Web
                        </div>
                        <h2 class="about-title">Muhammad Maulana Firdaussyah</h2>
                        <p class="about-nim">NIM: 233210013</p>
                        <div class="about-details">
                            <div class="about-item">
                                <i class="bi bi-building"></i>
                                <span>Program Studi Sistem Informasi Akuntansi</span>
                            </div>
                            <div class="about-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Universitas Teknologi Digital Indonesia</span>
                            </div>
                            <div class="about-item">
                                <i class="bi bi-calendar3"></i>
                                <span>Tahun Ajaran {{ date('Y') }}</span>
                            </div>
                            <div class="about-item">
                                <i class="bi bi-github"></i>
                                <a href="https://github.com/maulana-tech" target="_blank" class="github-link">github.com/maulana-tech</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-card" data-aos="zoom-in" data-aos-duration="600">
                <h2 class="cta-title">Siap Mengelola Bisnis Anda?</h2>
                <p class="cta-subtitle">Masuk ke dashboard sekarang dan mulai kelola inventaris dengan lebih efisien</p>
                <a href="{{ route('login') }}" class="btn-cta">
                    <i class="bi bi-box-arrow-in-right"></i> Login ke Dashboard
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="brand-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    Aplikasi Barang
                </div>
                <p class="footer-text">
                    &copy; {{ date('Y') }} Aplikasi Barang. Proyek-Web <i class="bi bi-heart-fill text-danger"></i> menggunakan Laravel
                </p>
                <div class="footer-links">
                    <a href="#features">Fitur</a>
                    <a href="#how-it-works">Cara Kerja</a>
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Chart Tab Switching
        function showChart(type) {
            document.getElementById('chart-bar').style.display = type === 'bar' ? 'block' : 'none';
            document.getElementById('chart-doughnut').style.display = type === 'doughnut' ? 'block' : 'none';
            document.getElementById('tab-bar').classList.toggle('active', type === 'bar');
            document.getElementById('tab-doughnut').classList.toggle('active', type === 'doughnut');
        }

        // Chart.js - Top Products Bar Chart
        const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
        new Chart(topProductsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($barangTerlaris->pluck('nama_barang')->map(fn($n) => strlen($n) > 12 ? substr($n, 0, 12) . '...' : $n)) !!},
                datasets: [{
                    label: 'Terjual',
                    data: {!! json_encode($barangTerlaris->pluck('total_terjual')) !!},
                    backgroundColor: [
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#8b5cf6',
                        '#ef4444'
                    ],
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { font: { size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 9 } }
                    }
                }
            }
        });

        // Chart.js - Category Doughnut Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($kategoriData->pluck('nama_jenis')) !!},
                datasets: [{
                    data: {!! json_encode($kategoriData->pluck('jumlah')) !!},
                    backgroundColor: [
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#8b5cf6',
                        '#ef4444',
                        '#06b6d4'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 12,
                            font: { size: 10 }
                        }
                    }
                },
                cutout: '60%'
            }
        });
    </script>
</body>
</html>
