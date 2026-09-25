#!/usr/bin/env bash
set -e

REPO="LouisaSianot/tradeconnect"   

echo "Creating labels..."
gh label create "role:customer"       --color "1F77B4" --force -R "$REPO"
gh label create "role:tradesperson"   --color "2CA02C" --force -R "$REPO"
gh label create "role:admin"          --color "D62728" --force -R "$REPO"
gh label create "role:system"         --color "9467BD" --force -R "$REPO"
gh label create "type:functional"     --color "FFA500" --force -R "$REPO"
gh label create "type:non-functional" --color "8C564B" --force -R "$REPO"
gh label create "priority:high"       --color "B60205" --force -R "$REPO"
gh label create "priority:medium"     --color "FBCA04" --force -R "$REPO"
gh label create "priority:low"        --color "0E8A16" --force -R "$REPO"

echo "Creating issues..."

create_issue() {
  local title="$1"
  local body="$2"
  local labels="$3"
  gh issue create -R "$REPO" --title "$title" --body "$body" --label "$labels"
}

# --- 3.1 User Authentication & Management ---
create_issue "FR-1.1 — User registration" "The system shall allow new users to register by providing a name, phone number, password, and role (customer or tradesperson).

Acceptance criteria:
- [ ] Registration form captures name, phone, password, role
- [ ] Phone number validated for format
- [ ] Password confirmed on entry" "role:system,type:functional,priority:high"

create_issue "FR-1.2 — User authentication" "The system shall authenticate users via phone number and password (securely hashed).

Acceptance criteria:
- [ ] Login form accepts phone + password
- [ ] Passwords hashed with Bcrypt/Argon2
- [ ] Invalid credentials show a clear error" "role:system,type:functional,priority:high"

create_issue "FR-1.3 — Restrict features to authenticated users" "The system shall restrict job posting, job response, and profile management features to authenticated users only.

Acceptance criteria:
- [ ] Protected routes require auth middleware
- [ ] Unauthenticated users redirected to login" "role:system,type:functional,priority:high"

# --- 3.2 Tradesperson Profile & Verification ---
create_issue "FR-2.1 — Create/edit tradesperson profile" "Tradespeople shall be able to create and edit a service profile, including trade category, description, and service area." "role:tradesperson,type:functional,priority:high"

create_issue "FR-2.2 — Submit verification documents" "Tradespeople shall be able to submit verification documents (identification, evidence of past work or referrals)." "role:tradesperson,type:functional,priority:high"

create_issue "FR-2.3 — Admin review verification" "Admin shall be able to review, approve, or reject verification submissions." "role:admin,type:functional,priority:high"

create_issue "FR-2.4 — Verification status badge" "The system shall display a verification status badge on each tradesperson's profile." "role:tradesperson,type:functional,priority:medium"

# --- 3.3 Job Posting & Management ---
create_issue "FR-3.1 — Post job request" "Customers shall be able to post a job request specifying trade category, description, and location." "role:customer,type:functional,priority:high"

create_issue "FR-3.2 — Browse/search jobs" "Tradespeople shall be able to browse and search job requests by trade category and location." "role:tradesperson,type:functional,priority:high"

create_issue "FR-3.3 — Respond to job request" "Tradespeople shall be able to respond to a job request." "role:tradesperson,type:functional,priority:high"

create_issue "FR-3.4 — Job status states" "The system shall track job status through defined states: posted → accepted → completed." "role:system,type:functional,priority:high"

create_issue "FR-3.5 — Mark job complete" "Customers and tradespeople shall be able to mark a job as completed." "role:system,type:functional,priority:high"

# --- 3.4 Ratings & Reviews ---
create_issue "FR-4.1 — Submit rating/review" "Customers shall be able to rate and leave a short review for a tradesperson after job completion." "role:customer,type:functional,priority:medium"

create_issue "FR-4.2 — View rating history" "Tradespeople shall be able to view their own rating and review history." "role:tradesperson,type:functional,priority:low"

create_issue "FR-4.3 — Average rating display" "The system shall display an average rating on each tradesperson's profile." "role:tradesperson,type:functional,priority:medium"

# --- 3.5 Dispute Handling ---
create_issue "FR-5.1 — Report dispute" "Customers or tradespeople shall be able to report a dispute relating to a specific job." "role:system,type:functional,priority:medium"

create_issue "FR-5.2 — Admin manage disputes" "Admin shall be able to view and manage reported disputes." "role:admin,type:functional,priority:medium"

create_issue "FR-5.3 — Suspend tradesperson" "Admin shall be able to suspend or remove a tradesperson profile where warranted." "role:admin,type:functional,priority:medium"

# --- 3.6 Notifications ---
create_issue "FR-6.1 — SMS notifications" "The system shall send an SMS notification when a new job request, job response, or job status change occurs." "role:system,type:functional,priority:high"

# --- 4.1 Usability ---
create_issue "NFR-1.1 — Responsive, low-bandwidth UI" "The UI shall be clean, responsive, and styled using a modern CSS framework (Tailwind/Bootstrap), with particular attention to low-bandwidth performance." "role:system,type:non-functional,priority:medium"

create_issue "NFR-1.2 — Client-side form validation" "Form inputs shall include basic client-side validation (required fields, valid phone number format)." "role:system,type:non-functional,priority:medium"

# --- 4.2 Security ---
create_issue "NFR-2.1 — Password hashing" "Passwords must be securely hashed using strong hashing algorithms (Bcrypt or Argon2)." "role:system,type:non-functional,priority:high"

create_issue "NFR-2.2 — Parameterized queries" "Database queries must use parameterized statements or ORM abstractions to prevent SQL injection." "role:system,type:non-functional,priority:high"

create_issue "NFR-2.3 — Secure verification document storage" "Verification documents must be stored securely, with access restricted to the admin role only." "role:system,type:non-functional,priority:high"

# --- 4.3 Performance ---
create_issue "NFR-3.1 — Page load performance" "Core dashboard, job, and profile views should load in under 2 seconds under standard local development conditions." "role:system,type:non-functional,priority:medium"

create_issue "NFR-3.2 — Image compression on upload" "Images (profile photos, job photos, verification documents) shall be compressed on upload for low-bandwidth usability." "role:system,type:non-functional,priority:medium"

# --- 4.4 Scalability & Extensibility ---
create_issue "NFR-4.1 — API-ready modular structure" "Backend code structure shall maintain clean modular separation to allow future expansion into a native mobile app or third-party API integrations." "role:system,type:non-functional,priority:low"

create_issue "NFR-4.2 — Soft deletes" "Jobs and tradesperson profiles shall support soft deletion (deleted_at) to preserve historical records." "role:system,type:non-functional,priority:medium"

create_issue "NFR-4.3 — Async SMS dispatch" "SMS notification dispatch shall run asynchronously via queue workers to prevent blocking web threads." "role:system,type:non-functional,priority:medium"

echo "Done. Created 9 labels and 26 issues in $REPO."
