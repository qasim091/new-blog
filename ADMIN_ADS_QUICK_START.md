# Quick Start: Home Page Ads Management

## ⚡ Quick Setup (3 Steps)

### Step 1: Run Migration
```bash
php artisan migrate
```

### Step 2: Access Admin Panel
- URL: `http://your-domain.com/admin/home-ads`
- Login with your admin credentials

### Step 3: Create Your First Ad
1. Click **"Add New Ad"**
2. Select **Position** (After Featured Post or Before Latest Posts)
3. Paste your **AdSense Code**
4. Check **Active** checkbox
5. Click **"Create Advertisement"**

---

## 📍 Admin Panel URLs

| Page | URL |
|------|-----|
| **Ads List** | `/admin/home-ads` |
| **Create Ad** | `/admin/home-ads/create` |
| **Edit Ad** | `/admin/home-ads/{id}/edit` |

---

## 🎯 Ad Positions

### 1. After Featured Post
- Appears right after the hero/featured post section
- High visibility placement
- Best for horizontal banners (728x90)

### 2. Before Latest Posts
- Appears before the latest articles grid
- Premium engagement zone
- Good for larger ads (336x280 or responsive)

---

## 📋 Form Fields Explained

| Field | Required | Description |
|-------|----------|-------------|
| **Ad Name** | No | Internal name for identification (e.g., "Top Banner") |
| **Position** | Yes | Where the ad appears on home page |
| **Order** | No | Display priority (lower = first, default: 0) |
| **Status** | No | Active/Inactive (checked = active) |
| **AdSense Code** | Yes | Complete AdSense ad code with `<script>` tags |

---

## 💡 Quick Tips

✅ **Multiple Ads**: You can add multiple ads to the same position  
✅ **Order Control**: Use order numbers like 0, 10, 20 for easy reordering  
✅ **Test First**: Create ads as inactive, test, then activate  
✅ **Toggle Status**: Click Active/Inactive button to quickly enable/disable ads  

---

## 🔄 Common Actions

### Activate/Deactivate an Ad
- In the ads list, click the **Active/Inactive** button
- No need to edit the ad

### Change Ad Position
1. Click **Edit** button
2. Select new **Position**
3. Click **Update**

### Delete an Ad
1. Click **Delete** button (trash icon)
2. Confirm deletion

---

## 📱 What You'll See

### Admin Panel Features:
- ✅ List of all ads with status
- ✅ Quick toggle for active/inactive
- ✅ Edit and delete buttons
- ✅ Position and order display
- ✅ Success/error messages

### Home Page Display:
- ✅ Ads appear automatically in selected positions
- ✅ Only active ads are shown
- ✅ Ads display in order (lowest number first)
- ✅ "Advertisement" label above each ad

---

## 🎨 Example AdSense Code

```html
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXX"
        crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-XXXXXXXXXX"
     data-ad-slot="YYYYYYYYYY"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
```

Replace:
- `ca-pub-XXXXXXXXXX` with your Publisher ID
- `YYYYYYYYYY` with your Ad Slot ID

---

## ✅ Checklist

- [ ] Run migration: `php artisan migrate`
- [ ] Login to admin panel
- [ ] Navigate to `/admin/home-ads`
- [ ] Create first ad
- [ ] Set position and status
- [ ] Paste AdSense code
- [ ] Save and view on home page
- [ ] Verify ad displays correctly

---

## 🚨 Troubleshooting

**Ads not showing?**
- Check if ad is Active
- Clear cache: `php artisan cache:clear`
- Verify AdSense code is complete

**Can't access admin panel?**
- Make sure you're logged in as admin
- Check route: `/admin/home-ads`

**Migration error?**
- Check database connection in `.env`
- Run: `php artisan migrate:fresh` (⚠️ This will reset database)

---

**Ready to start? Run the migration and visit `/admin/home-ads`!** 🚀
