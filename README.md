# 💳 Chit.Money Collector API — Endpoint Checklist

### 🧑‍💼 Collector Profile

-   [x] `GET    /collectors/profile` — Get collector profile
-   [x] `POST   /collectors/profile` — Create collector profile
-   [x] `PUT    /collectors/profile` — Update collector profile
-   [x] `DELETE /collectors/profile` — Delete collector profile

---

### ☎️ Contact Info

-   [x] `GET    /collectors/contact` — Get contact information
-   [x] `PUT    /collectors/contact` — Update or create contact information

---

### 🏦 Bank Details

-   [x] `GET    /collectors/bank-details` — Get bank details
-   [x] `PUT    /collectors/bank-details` — Update or create bank details

---

### 🏢 Organization Management

-   [x] `GET    /collectors/organization` — Get organization info
-   [x] `PUT    /collectors/organization` — Update or create organization info

---

### 📦 Batch Management

-   [x] `GET    /collectors/organization/{orgId}/batches` — Get all batches for organization
-   [x] `POST   /collectors/organization/{orgId}/batches` — Create batch in organization
-   [x] `GET    /collectors/batches/{batchId}` — Get single batch details
-   [x] `PUT    /collectors/batches/{batchId}` — Update batch
-   [x] `DELETE /collectors/batches/{batchId}` — Delete batch
