# Home Page Ads Management System - Setup Guide

## 🎉 System Overview

You now have a complete admin panel system to manage AdSense advertisements on your home page. You can add, edit, delete, and control the position of ads directly from the admin dashboard.

---

## 📋 Setup Instructions

### Step 1: Run Database Migration

Run the following command to create the `home_ads` table in your database:

```bash
php artisan migrate
```

This will create a table to store your advertisement data.

---

## 🎯 Features

### Admin Panel Features:
- ✅ **Add New Ads** - Create advertisements with custom AdSense code
- ✅ **Edit Ads** - Modify existing advertisements
- ✅ **Delete Ads** - Remove unwanted advertisements
- ✅ **Toggle Status** - Activate/Deactivate ads with one click
- ✅ **Position Control** - Choose where ads appear on the home page
- ✅ **Order Management** - Control the display order of multiple ads
- ✅ **Live Preview** - See ads immediately on your home page

### Available Ad Positions:
1. **After Featured Post** - Displays after the featured post section
2. **Before Latest Posts** - Displays before the latest articles section

---

## 🚀 How to Use

### Access the Admin Panel:

1. **Login to Admin Dashboard**
   - Navigate to: `/admin`
   - Login with your admin credentials

2. **Go to Home Ads Management**
   - Navigate to: `/admin/home-ads`
   - Or access via the admin menu

### Create a New Advertisement:

1. Click **"Add New Ad"** button
2. Fill in the form:
   - **Ad Name** (Optional): Give it a name for easy identification (e.g., "Top Banner")
   - **Position**: Select where you want the ad to appear
     - After Featured Post
     - Before Latest Posts
   - **Order**: Set the display order (lower number = higher priority)
   - **Status**: Check to make it active
   - **AdSense Code**: Paste your complete AdSense ad code

3. Click **"Create Advertisement"**

### Edit an Advertisement:

1. Go to **Home Ads** list
2. Click the **Edit** button (pencil icon)
3. Modify the fields as needed
4. Click **"Update Advertisement"**

### Toggle Ad Status:

1. In the ads list, click the **Active/Inactive** button
2. The status will toggle immediately

### Delete an Advertisement:

1. Click the **Delete** button (trash icon)
2. Confirm the deletion

---

## 📊 Database Structure

The `home_ads` table contains:

| Field | Type | Description |
|-------|------|-------------|
| id | Integer | Unique identifier |
| name | String | Ad name (optional) |
| position | Enum | Ad position (after_featured, before_latest) |
| ad_code | Text | Complete AdSense code |
| is_active | Boolean | Active status |
| order | Integer | Display order |
| created_at | Timestamp | Creation date |
| updated_at | Timestamp | Last update date |

---

## 🔧 Technical Details

### Files Created:

1. **Migration**: `database/migrations/2025_11_08_123700_create_home_ads_table.php`
2. **Model**: `app/Models/HomeAd.php`
3. **Controller**: `app/Http/Controllers/Admin/HomeAdController.php`
4. **Views**:
   - `resources/views/dashboard/admin/home_ads/index.blade.php`
   - `resources/views/dashboard/admin/home_ads/create.blade.php`
   - `resources/views/dashboard/admin/home_ads/edit.blade.php`

### Routes Added:

```php
GET    /admin/home-ads                    - List all ads
GET    /admin/home-ads/create             - Show create form
POST   /admin/home-ads                    - Store new ad
GET    /admin/home-ads/{id}/edit          - Show edit form
PUT    /admin/home-ads/{id}               - Update ad
DELETE /admin/home-ads/{id}               - Delete ad
PATCH  /admin/home-ads/{id}/toggle-status - Toggle active status
```

---

## 💡 Usage Examples

### Example 1: Add a Banner Ad After Featured Post

1. Go to `/admin/home-ads`
2. Click "Add New Ad"
3. Fill in:
   - Name: "Top Banner Ad"
   - Position: "After Featured Post"
   - Order: 0
   - Status: ✓ Active
   - AdSense Code: (paste your code)
4. Save

### Example 2: Add Multiple Ads in Same Position

You can add multiple ads to the same position. They will display in order:

**Ad 1:**
- Name: "Primary Banner"
- Position: "Before Latest Posts"
- Order: 1

**Ad 2:**
- Name: "Secondary Banner"
- Position: "Before Latest Posts"
- Order: 2

Both ads will appear before latest posts, with "Primary Banner" showing first.

---

## 🎨 Frontend Display

The home page automatically displays active ads in their designated positions:

```blade
<!-- After Featured Post -->
@if($adsAfterFeatured->count() > 0)
    @foreach($adsAfterFeatured as $ad)
        <!-- Ad displays here -->
    @endforeach
@endif

<!-- Before Latest Posts -->
@if($adsBeforeLatest->count() > 0)
    @foreach($adsBeforeLatest as $ad)
        <!-- Ad displays here -->
    @endforeach
@endif
```

---

## 🔒 Security Notes

- ✅ All routes are protected by admin authentication
- ✅ AdSense code is stored safely in the database
- ✅ XSS protection is maintained (use `{!! !!}` for ad code rendering)
- ✅ Input validation on all forms

---

## 📝 Best Practices

1. **Test Ads First**: Create ads with inactive status, preview them, then activate
2. **Use Descriptive Names**: Name your ads clearly (e.g., "Homepage Top Banner - 728x90")
3. **Order Wisely**: Use order numbers with gaps (0, 10, 20) to allow easy insertion later
4. **Monitor Performance**: Check AdSense dashboard to see which positions perform best
5. **Don't Overload**: Avoid placing too many ads in one position

---

## 🐛 Troubleshooting

### Ads Not Showing?
- Check if the ad is set to "Active"
- Verify the position is correct
- Clear cache: `php artisan cache:clear`
- Check browser console for JavaScript errors

### AdSense Code Not Working?
- Ensure you copied the complete code including `<script>` tags
- Verify your AdSense account is approved
- Wait 24-48 hours for new ad units to activate

### Database Error?
- Make sure you ran the migration: `php artisan migrate`
- Check database connection in `.env` file

---

## 🎯 Next Steps

1. **Run Migration**: `php artisan migrate`
2. **Login to Admin Panel**: `/admin`
3. **Navigate to Home Ads**: `/admin/home-ads`
4. **Create Your First Ad**
5. **View on Home Page**: `/`

---

## 📞 Support

If you encounter any issues:
1. Check the Laravel logs: `storage/logs/laravel.log`
2. Verify all files are created correctly
3. Ensure database migration ran successfully
4. Clear application cache

---

**Created**: November 8, 2025  
**Version**: 1.0  
**Status**: Ready to Use ✅
