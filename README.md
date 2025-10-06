# Teceze Global Pricebook Calculator

A complete PHP web application for calculating prices based on Teceze's global service rates. This application allows users to select from different service levels (L1-L5) and calculate pricing for various locations worldwide.

## 🚀 Features

- **Dynamic Service Selection**: Dropdown populated with all available service levels from the pricebook data
- **Location-Based Pricing**: Optional location selection for accurate regional pricing
- **Real-Time Calculation**: Instant price calculation with quantity input
- **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices
- **Clean UI**: Modern, professional interface with gradient backgrounds and smooth animations
- **Error Handling**: Comprehensive validation and error reporting
- **Offline Functionality**: Works entirely with PHP, no JavaScript dependencies required

## 📋 Requirements

- PHP 7.0 or higher
- Web server (Apache, Nginx, or any PHP-compatible server)
- JSON extension for PHP (usually enabled by default)

## 🛠️ Installation & Setup

### Option 1: XAMPP (Local Development)

1. **Install XAMPP**:
   - Download XAMPP from [apachefriends.org](https://www.apachefriends.org/)
   - Install XAMPP following the setup wizard

2. **Start XAMPP**:
   - Launch XAMPP Control Panel
   - Start Apache and MySQL modules

3. **Deploy the Application**:
   - Copy all files (`index.php`, `process.php`, `style.css`, `Teceze_Global_Pricebook_all_sheets.json`) to:
     ```
     C:\xampp\htdocs\teceze_pricebook_calculator\
     ```

4. **Access the Application**:
   - Open your browser and navigate to: `http://localhost/teceze_pricebook_calculator/`

### Option 2: 000Webhost (Free Online Hosting)

1. **Create Account**:
   - Visit [000webhost.com](https://www.000webhost.com/)
   - Sign up for a free account

2. **Upload Files**:
   - Go to your 000Webhost control panel
   - Navigate to "File Manager"
   - Upload all application files to the `public_html` directory

3. **Access Online**:
   - Your application will be available at: `https://yoursite.000webhostapp.com/`

### Option 3: Other Web Hosting

1. **Upload via FTP**:
   - Connect to your web hosting via FTP
   - Upload all files to your web root directory (usually `public_html` or `www`)

2. **Ensure PHP Support**:
   - Make sure your hosting provider supports PHP 7.0+
   - Check that file permissions are set correctly (755 for directories, 644 for files)

## 📖 How to Use

1. **Select Service**:
   - Choose from the dropdown list (L1 through L5)
   - Each level represents different experience requirements and complexity

2. **Enter Quantity**:
   - Input the number of hours/units needed
   - Minimum value is 1

3. **Choose Location (Optional)**:
   - Select a specific region/country for location-based pricing
   - Leave blank for default pricing

4. **Calculate**:
   - Click "Calculate Price" button
   - View results below the form

## 🎯 Service Levels

- **L1**: Basic Support (Minimum 6 months experience)
- **L2**: Advanced Support (Minimum 18 months experience)
- **L3**: Expert Support (Minimum 2 years experience)
- **L4**: Senior Expert (3-5 years experience)
- **L5**: Architecture & Planning (5+ years experience)

## 📁 File Structure

```
teceze_pricebook_calculator/
├── index.php                          # Main application interface
├── process.php                        # Form processing and calculations
├── style.css                          # Application styling
├── Teceze_Global_Pricebook_all_sheets.json  # Price data
└── README.md                          # This file
```

## 🔧 Configuration

### Customizing the Application

1. **Update Service Descriptions**:
   - Edit the service names in `process.php` in the `getServiceName()` function

2. **Modify Styling**:
   - Edit `style.css` to customize colors, fonts, and layout

3. **Add New Price Data**:
   - Update `Teceze_Global_Pricebook_all_sheets.json` with new pricing information

### Troubleshooting

**Common Issues:**

1. **"Error: Service not found"**:
   - Ensure the JSON file is in the same directory as the PHP files
   - Check that the JSON file format is valid

2. **"Error: Missing data"**:
   - Make sure all required fields are filled in the form

3. **Styling not loading**:
   - Verify that `style.css` is in the same directory as `index.php`
   - Check file permissions

## 🌐 Browser Compatibility

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- Opera 47+

## 📝 License

This application is developed for Teceze Global. All rights reserved.

## 🆘 Support

For technical support or questions about the application:
- Check the troubleshooting section above
- Ensure all files are properly uploaded
- Verify PHP version compatibility
- Check file permissions on your server

## 🔄 Updates

To update the application:
1. Backup your current installation
2. Replace the files with the new versions
3. Test the functionality
4. Clear browser cache if needed

---

**Note**: This application uses the pricing data from `Teceze_Global_Pricebook_all_sheets.json`. Make sure this file is kept up-to-date with the latest pricing information for accurate calculations.
