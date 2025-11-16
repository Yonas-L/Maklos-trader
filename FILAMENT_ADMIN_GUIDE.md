# Filament Admin Panel Guide

## Access
- URL: `http://127.0.0.1:8000/adminPanel`
- Email: `admin@example.com`
- Password: `password`

## Managing Content

### 1. Hero Slides
- Navigate to "Hero Slides" in sidebar
- Click "New Hero Slide" to add
- Fields:
  - Title: Main heading text
  - Caption: Subtitle text
  - Image: Upload slide image
  - Button Primary Label: Main button text
  - Button Primary URL: Main button link
  - Button Secondary Label: Optional secondary button
  - Button Secondary URL: Secondary button link
  - Sort Order: Display order (lower numbers first)
  - Is Active: Toggle visibility

### 2. About Content
- Navigate to "About Content"
- Edit mission and vision descriptions
- Mission Highlights & Vision Highlights: JSON arrays like:
  ```json
  [
    {"label": "Quality Control", "copy": "Every formulation is tested..."},
    {"label": "Affordable Care", "copy": "Pricing remains accessible..."}
  ]
  ```

### 3. About Values
- Navigate to "About Values"
- Add company values with:
  - Title: Value name (e.g., "Quality Commitment")
  - Badge: Short label (e.g., "Quality")
  - Summary: Brief description
  - Type: mission/vision/values
  - Accent Color: Theme color
  - Sort Order: Display order

### 4. Manufacturing Steps
- Navigate to "Manufacturing Steps"
- Add production steps:
  - Step Number: Display number (e.g., "01")
  - Badge: Category label
  - Title: Step title
  - Description: Detailed description
  - Features: JSON array of features
  - Image: Step illustration

### 5. Product Highlights
- Navigate to "Product Highlights"
- Manage featured products:
  - Name: Product name
  - Description: Product description
  - Image: Product photo
  - Tags: Comma-separated tags
  - Category: Product category
  - Sort Order: Display order

### 6. FAQ Items
- Navigate to "FAQ Items"
- Add FAQs:
  - Question: FAQ question
  - Answer: Detailed answer
  - Category: FAQ category
  - Sort Order: Display order
  - Is Active: Toggle visibility

### 7. Site Settings
- Navigate to "Site Settings"
- Update global settings:
  - Site Name: Website title
  - Site Description: Meta description
  - Contact Email: Contact information
  - Phone: Contact phone
  - Address: Business address
  - Social Links: Social media URLs

## Tips
- Use drag-and-drop to reorder items
- All changes are saved automatically
- Use "Is Active" toggle to show/hide content
- Images are stored in `storage/app/public` directory
