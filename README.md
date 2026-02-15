# Laundry Management System

A web-based Laundry Management System built with Laravel that manages orders, customers, employees, and transactions with location-based services and payment gateway integration.

---

## Project Overview

Laundry Management System is a full-stack web application designed to support operational management for a laundry business. 

The system supports three main roles:
### - Customer
### - Admin
### - Staff (Petugas)

Customers can create laundry service requests, set pickup locations using map-based services, and complete payments through Midtrans (sandbox simulation).
Admin manages users, services, employees, orders, and reporting through a dashboard interface.

The courier–customer operational workflow is not yet implemented and is planned as a future enhancement.

This project was developed to simulate a real-world transaction system using RESTful architecture and third-party API integration.

---

## User Roles & Features

### Customer

- Register with email (email verification via Mailtrap sandbox)
- Login with email/password
- Login using Google OAuth
- Create laundry service requests
- Set pickup location using OpenStreetMap (Leaflet.js)
- Reverse geocoding with Nominatim API
- View order status
- View Dashboard 
- Complete payment using Midtrans (sandbox mode)

### Admin & Staff

- Dashboard overview
- Manage customers
- Manage employees (activate/deactivate system access)
- Manage laundry services
- Manage orders
- View transaction reports

---

## Technical Implementation

- RESTful API architecture
- MVC pattern using Laravel
- Role-based access control
- Relational database design (MySQL)
- Middleware-based authentication
- Google OAuth integration
- Email verification (Mailtrap sandbox)
- Midtrans payment gateway (simulation)
- OpenStreetMap integration with Leaflet.js
- Reverse geocoding using Nominatim API

Current Limitations
- Courier–customer business workflow is not yet implemented
- Payment is sandbox simulation only
- Email verification uses Mailtrap (development environment)

Future Improvements

- Courier assignment and tracking system
- Real-time order tracking
- Production payment gateway configuration
- Notification system
- Performance optimization

## Tech Stack

### Backend
- Laravel
- PHP
- RESTful API
- MySQL

### Frontend
- Blade Template
- JavaScript
- Tailwind CSS

### Third-Party Integration
- OpenStreetMap
- Leaflet.js
- Nominatim API
- Midtrans (Sandbox)
- Google OAuth
- Mailtrap

---

## Screenshots

<img width="1353" height="555" alt="image" src="https://github.com/user-attachments/assets/78945c25-8d91-4b40-8660-c4bc66124cf0" />
<img width="1351" height="606" alt="image" src="https://github.com/user-attachments/assets/4c515496-6410-4b76-874b-970c05a42e00" />
<img width="1348" height="611" alt="image" src="https://github.com/user-attachments/assets/9c54ea5b-ff01-411b-b110-bd4283d0b21a" />
<img width="1346" height="612" alt="image" src="https://github.com/user-attachments/assets/c49264a8-e0bf-40e4-b75e-f05515d510b5" />
<img width="1366" height="616" alt="image" src="https://github.com/user-attachments/assets/ead387fd-9d4d-4b9a-9d69-74ffecf9405f" />
<img width="1366" height="619" alt="image" src="https://github.com/user-attachments/assets/dfae65a1-6ea9-4583-9d66-ec8d3642dd14" />
<img width="1363" height="604" alt="image" src="https://github.com/user-attachments/assets/eb022c95-75ae-4c6f-9c2b-41e89125b80f" />
<img width="1366" height="616" alt="image" src="https://github.com/user-attachments/assets/a32033df-0533-4a57-a6f1-d27671daf665" />
<img width="238" height="475" alt="image" src="https://github.com/user-attachments/assets/ede380ed-7179-4e4f-a8ad-e8e203349ba5" />
<img width="843" height="557" alt="image" src="https://github.com/user-attachments/assets/a2d24a2a-284e-408a-930f-d0faa6ba2470" />


<img width="1366" height="618" alt="image" src="https://github.com/user-attachments/assets/e2e71a8b-a10f-4a68-8d74-8ca4f1e341ba" />
