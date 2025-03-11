# 📚 Book Reviews Application

![Laravel Version](https://img.shields.io/badge/Laravel-10.x-red.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.1-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

A feature-rich book review platform that enables users to discover, rate, and review books. Built with Laravel and modern web technologies.

![Book Reviews App Screenshot](public/screenshots/home.png)

## ✨ Features

- 👤 User authentication and profile management
- 📖 Book browsing with search and filter capabilities
- ⭐ Rating and reviewing functionality
- 🔍 Advanced search options
- 📱 Responsive design for all devices
- 📊 User dashboards with reading progress

## 🛠️ Tech Stack

- **Framework:** Laravel 10
- **Database:** MySQL
- **Frontend:** Blade templates, Tailwind CSS
- **Authentication:** Laravel Fortify
- **Storage:** Laravel Storage (file uploads)

## 🚀 Installation

1. Clone the repository
   ```bash
   git clone https://github.com/gugalomidze/book-reviews-app.git
   ```

2. Navigate to project directory
   ```bash
   cd book-reviews-app
   ```

3. Install dependencies
   ```bash
   composer install
   npm install
   ```

4. Copy environment file and set up your environment variables
   ```bash
   cp .env.example .env
   ```

5. Generate application key
   ```bash
   php artisan key:generate
   ```

6. Run migrations and seed the database
   ```bash
   php artisan migrate --seed
   ```

7. Start the development server
   ```bash
   php artisan serve
   ```

## 🌟 Usage

- Register a new account or login
- Browse books in the library
- Add reviews and ratings to books
- Manage your profile and book collections
- Upload new books (admin only)

## 🔧 Configuration

Details about important configuration settings for the application.

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 📞 Contact

For any inquiries or support, please contact [your-email@example.com](mailto:your-email@example.com)
```

## 2. სქრინშოთების დამატება

```bash
mkdir -p public/screenshots
```

აქ ატვირთეთ თქვენი პროექტის რამდენიმე სქრინშოთი (მთავარი გვერდი, წიგნის დეტალები, მიმოხილვები).

## 3. თემატური ლოგოს დამატება

შექმენით მარტივი ლოგო [Canva](https://www.canva.com/)-ს გამოყენებით და ატვირთეთ `public/images/logo.png` მისამართზე.

## 4. აღწერის განახლება GitHub-ზე

1. გადადით რეპოზიტორიის Settings-ში
2. განაახლეთ Description:
   ```
   📚 Modern book review platform built with Laravel. Elegant UI, feature-rich, and easy to use. Full rating system and user reviews.
