# Deploy to Railway (FREE) ✅

Railway is the **best free option** for deploying Laravel apps with a database.

**Cost:** $0/month (with $5 free credit monthly)

---

## 🚀 Quick Start (2 Minutes)

### 1. Create Railway Account
- Go to https://railway.app
- Click "Start New Project"
- Sign up with GitHub

### 2. Deploy from GitHub
1. Click "Deploy from GitHub repo"
2. Authorize Railway with your GitHub account
3. Select: `Alfcodes/finance`
4. Click "Deploy Now"

Railway will:
- ✅ Clone your repo
- ✅ Detect Laravel automatically
- ✅ Build your app
- ✅ Deploy it live

**Wait 3-5 minutes for build to complete...**

### 3. Add PostgreSQL Database
1. In Railway dashboard, click **"+ Add"**
2. Select **"PostgreSQL"**
3. Click **"Create Database"**

Railway automatically:
- ✅ Creates database
- ✅ Sets environment variables
- ✅ Connects to your app

### 4. Set Additional Variables
Click on your **web service** → **Variables** tab

Add these:
```
APP_NAME=PersonalFinance
APP_ENV=production
APP_DEBUG=false
LOG_CHANNEL=stderr
SESSION_DRIVER=cookie
CACHE_DRIVER=redis
```

### 5. Deploy!
Click **"Deploy"** button. Your app will be live in 2 minutes!

**Your URL:** `https://your-app-name.up.railway.app`

---

## ✅ That's It!

Your app is now:
- ✅ Live on the internet
- ✅ Connected to PostgreSQL
- ✅ Auto-deployed from GitHub
- ✅ HTTPS enabled
- ✅ Completely FREE

---

## 🔄 Auto-Deployment

Every time you push to GitHub:
1. Railway detects the push
2. Automatically rebuilds
3. Deploys new version

**No manual deployment needed!** 🎉

---

## 📱 Test Your API

Once deployed, test your API:

```bash
# Login
curl -X POST https://your-app.up.railway.app/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Get stats
curl -X GET https://your-app.up.railway.app/api/stats \
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## 🆓 Free Tier Details

**Railway Free Credits:**
- $5/month free credit
- Enough for:
  - Small web service ($0.15/hour)
  - PostgreSQL database ($3-5/month)
  - Total: Well within free credits!

**Limitations:**
- None! Full-powered app
- Same performance as paid tiers
- Auto-scales as needed

---

## 📈 If You Need More Later

When you outgrow free tier (unlikely):
- Upgrade to pay-as-you-go
- Pricing starts at $0.04/hour for services
- Only pay for what you use
- No minimum commitment

---

## ⚙️ Environment Variables Reference

Railway auto-sets:
- `DATABASE_URL` - PostgreSQL connection string
- `DB_HOST` - Database host
- `DB_PORT` - Database port (5432)
- `DB_DATABASE` - Database name
- `DB_USERNAME` - Database user
- `DB_PASSWORD` - Database password

You add:
- `APP_KEY` - Generate with `php artisan key:generate --show`
- `APP_ENV` - Set to `production`
- `APP_DEBUG` - Set to `false`

---

## 🆘 Troubleshooting

### "Build failed"
- Check Railway logs: **Logs** tab
- Usually missing `APP_KEY`
- Generate key locally: `php artisan key:generate --show`
- Add to Railway variables

### "Database connection error"
- Wait 1-2 minutes for database to initialize
- Verify PostgreSQL service is running (green dot)
- Check DATABASE_URL is set automatically

### "500 error on app"
- Check logs in Railway dashboard
- Common: Missing APP_KEY
- Solution: Generate and add APP_KEY variable

### "Slow app startup"
- Free tier narrows containers during inactivity
- First load might be slow
- Subsequent loads are fast
- Normal behavior

---

## 🚀 Next Steps

1. ✅ Deploy to Railway (this guide)
2. ✅ Test the app at your Railway URL
3. ✅ Test API with curl/Postman
4. ✅ Register an account
5. ✅ Add some expense data
6. ✅ Check dashboard with charts

---

## 📊 Free Option Comparison

| Platform | Cost | Setup | Database | Best For |
|----------|------|-------|----------|----------|
| **Railway** | FREE | 2 min | ✅ Included | ⭐ Laravel apps |
| Render | FREE | 5 min | ✅ Included | Small apps |
| Replit | FREE | 3 min | ✅ Included | Learning |
| DigitalOcean | $5/mo | 5 min | ✅ Included | Production |
| Heroku | ❌ Discontinued | - | - | - |

---

## 💾 Backups

Railway automatically:
- ✅ Backs up your database
- ✅ Version control via GitHub
- ✅ Can restore previous deployments

No action needed!

---

## 📞 Support

- **Railway Docs:** https://docs.railway.app
- **Railway Community:** https://railway.app/support
- **Issues:** Check Railway logs for errors

---

## ✨ Summary

Your Personal Finance App is now:
- 🆓 Completely FREE
- 🚀 Deployed and live
- 📊 With real PostgreSQL database
- 🔄 Auto-deploying from GitHub
- 🔒 HTTPS enabled
- ⚡ Ready for production

**Start using it now!** 🎉

Visit your Railway app URL and register your first account!
