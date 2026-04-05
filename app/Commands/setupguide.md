# ⏱ Cron Job & Newsletter Setup Guide

This project uses **daycry/cronjob** to automate newsletter emails.

---

## 📧 Newsletter Overview

- Sends latest **5 news articles**
- Sent to all subscribed users
- Runs **twice daily**
  - Morning → 8:00 AM
  - Evening → 6:00 PM
- Includes **unsubscribe link**
- Prevents duplicate emails using `last_sent_at`

---

## ⚙️ How It Works

1. Server cron runs every minute  
2. Scheduler checks tasks  
3. At scheduled time → runs:

php spark newsletter:send

---

## 🧪 Local Testing

Run cron manually:

php spark cronjob:run

Run newsletter manually:

php spark newsletter:send

Enable cron system (first time only):

php spark cronjob:enable

---

## 🌍 Production Setup

### 1. Find PHP path

which php

Example:

/usr/bin/php

---

### 2. Find project path

Example:

/home/username/public_html

---

### 3. Add Cron Job (IMPORTANT)

Go to cPanel / Hostinger → Cron Jobs

Add this:

* * * * * /usr/bin/php /home/username/public_html/spark cronjob:run

---

## ⏰ Scheduler Config

File: app/Config/CronJob.php

$schedule->command('newsletter:send')
    ->daily('08:00')
    ->named('newsletter_morning');

$schedule->command('newsletter:send')
    ->daily('18:00')
    ->named('newsletter_evening');

---

## 🧪 Testing Mode (Optional)

For testing only:

->everyMinute()

⚠️ Remove this in production or emails will spam users.

---

## 📊 Logs

Check logs here:

writable/cronJob/

---

## 🛠 Newsletter Command

File: app/Commands/SendNewsletter.php

Features:
- Sends latest 5 news
- Loops through subscribers
- Uses HTML email template
- Updates last_sent_at
- Avoids duplicate sending

---

## 📩 Subscription System

Subscribe:

POST /subscribe

Unsubscribe:

GET /unsubscribe/{token}

---

## 🗄 Database Table

newsletter_subscribers

Fields:
- id
- email
- token
- is_active
- last_sent_at
- created_at

---

## 🔁 Alternative (if CLI not working)

Use URL:

https://yourdomain.com/cron/newsletter

Cron:

* * * * * curl -s https://yourdomain.com/cron/newsletter > /dev/null 2>&1

---

## ⚠️ Common Issues

Command not found:

php spark

Check if newsletter:send exists.

---

Cron runs but nothing happens:

- No subscribers
- is_active = 0
- No news posts

---

Emails not sending:

- Check app/Config/Email.php
- Check SMTP credentials
- Check spam folder

---

## ✅ Final Setup

✔ Cron runs every minute  
✔ Scheduler controls timing  
✔ Newsletter runs twice daily  
✔ Users can unsubscribe  
