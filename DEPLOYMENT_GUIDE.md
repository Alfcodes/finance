# Deployment Guide - Personal Finance App

## 🚀 Deploy to DigitalOcean App Platform (Recommended)

DigitalOcean App Platform is the best option for Laravel - it's easy, affordable, and has excellent GitHub integration.

### Step 1: Create DigitalOcean Account
1. Go to https://www.digitalocean.com
2. Sign up or log in
3. Create a new account (free $100 credit with referral)

### Step 2: Create App Platform Project
1. Click "Create" → "App"
2. Connect your GitHub account
3. Select repository: `Alfcodes/finance`
4. Branch: `main`
5. Click "Next"

### Step 3: Configure App Settings
1. **Service name**: `web`
2. **Build Command**: 
   ```
   composer install && npm install && npm run build && php artisan config:cache
   ```
3. **Run Command**: 
   ```
   php artisan migrate --force && php-fpm
   ```
4. **HTTP Port**: `8080`
5. Click "Next"

### Step 4: Add Database (PostgreSQL)
1. Click "Create a new database"
2. **Database name**: `personalfinance`
3. **Database engine**: PostgreSQL 14
4. **Cluster name**: `db-pf`
5. Click "Create"

### Step 5: Set Environment Variables
Click "Add Env" and add these variables:

```
APP_NAME=PersonalFinance
APP_ENV=production
APP_DEBUG=false
LOG_CHANNEL=stderr
CACHE_DRIVER=redis
SESSION_DRIVER=cookie
```

The database variables will be auto-set by DigitalOcean.

### Step 6: Generate APP_KEY
```bash
# In your terminal
php artisan key:generate --show
```

Copy the key and add it as `APP_KEY` environment variable in DigitalOcean.

### Step 7: Deploy!
1. Review your settings
2. Click "Create App"
3. Wait for deployment (5-10 minutes)
4. Your app will be live at: `https://your-app-name.ondigitalocean.app`

---

## 🔧 Post-Deployment Steps

### 1. Verify Database Connection
Visit your app URL and try to register a new account.

### 2. Generate App Key (if not already done)
```bash
doctl apps logs --app-id=YOUR_APP_ID web
```

### 3. Configure Custom Domain (Optional)
1. Go to App Settings → Domains
2. Add your custom domain
3. Update DNS records (shown in DigitalOcean)

### 4. Enable HTTPS
DigitalOcean automatically enables HTTPS with Let's Encrypt.

### 5. Monitor Logs
In DigitalOcean dashboard: **Logs** tab to see app logs and errors.

---

## 📊 Pricing

**DigitalOcean App Platform:**
- Web service (shared): $5-12/month (based on usage)
- PostgreSQL database: $15/month (starting)
- Total starting: ~$20/month

**Free tier:** 3 months free App Platform ($12/month value)

---

## 🛠️ Troubleshooting

### "500 Internal Server Error"
Check logs in DigitalOcean dashboard. Usually:
- Missing `APP_KEY`
- Database connection failed
- Missing environment variable

### "Database connection refused"
- Verify `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD`
- Database may still be initializing (wait 5 minutes)

### "Composer install fails"
- Increase build memory: Check DigitalOcean logs
- Remove package-lock.json and retry

### App keeps restarting
- Check logs for errors
- Verify all environment variables are set
- Run migrations locally first: `php artisan migrate`

---

## 🔄 Continuous Deployment

**Automatic deploys are enabled!**

Every time you push to the `main` branch on GitHub:
1. DigitalOcean detects the push
2. Automatically rebuilds the app
3. Runs migrations
4. Deploys new version

No manual deployment needed after initial setup! 🎉

---

## 🆘 Alternative Deployment Options

### Option 2: Deploy to Heroku
1. Install Heroku CLI
2. `heroku create your-app-name`
3. `git push heroku main`
4. `heroku addons:create heroku-postgresql:hobby-dev`

### Option 3: Manual VPS (DigitalOcean Droplet)
1. Create $5/month Droplet (Ubuntu 20.04)
2. Install: PHP 8.3, Composer, Node.js, PostgreSQL
3. Clone repo
4. Set up Nginx reverse proxy
5. Configure SSL with Certbot

### Option 4: AWS Elastic Beanstalk
1. Create EB environment
2. Upload code
3. Configure RDS database
4. Deploy

---

## 📱 API Access After Deployment

Once deployed, your API is live at:

```
https://your-app-name.ondigitalocean.app/api/
```

### Example: Get Dashboard Stats
```bash
# Login to get token
curl -X POST https://your-app-name.ondigitalocean.app/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Use token to get stats
curl -X GET https://your-app-name.ondigitalocean.app/api/stats \
  -H "Authorization: Bearer TOKEN"
```

---

## 🔒 Security Checklist

After deployment:
- [ ] Set `APP_DEBUG=false`
- [ ] Generate strong `APP_KEY`
- [ ] Enable HTTPS (automatic with DigitalOcean)
- [ ] Configure strong database password
- [ ] Set up email for password reset
- [ ] Enable firewalls
- [ ] Regular backups (DigitalOcean handles automatically)
- [ ] Monitor logs for suspicious activity

---

## 📈 Scaling Up (Future)

When you need more power:
1. **Upgrade database**: PostgreSQL Premium ($65+/month)
2. **Add cache layer**: Redis for session/cache ($15+/month)
3. **Add workers**: Background job processing
4. **Load balancer**: Distribute traffic across multiple app instances

---

## 📞 Support & Resources

- **DigitalOcean Docs**: https://docs.digitalocean.com/products/app-platform/
- **Laravel Deployment**: https://laravel.com/docs/deployment
- **DigitalOcean Support**: support.digitalocean.com

---

## ✅ Deployment Complete!

Your Personal Finance App is now:
- ✅ Live on the internet
- ✅ Using PostgreSQL database
- ✅ Auto-deployed from GitHub
- ✅ Protected with HTTPS
- ✅ Ready for production traffic

**Enjoy your deployed app!** 🎉
