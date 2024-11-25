# **MongoDB Integration with Laravel**

---

## **Project Description**

This project integrates **MongoDB** with a Laravel application using the `jenssegers/mongodb` package. It demonstrates how to build flexible, scalable APIs that efficiently store, validate, and retrieve data from a MongoDB database.

The implementation supports advanced validation, custom data handling, and seamless communication with the MongoDB database.

---

## **Technologies Used**

- **Framework:** Laravel 10
- **Database:** MongoDB
- **MongoDB Integration Package:** `jenssegers/mongodb` v4.8.1
- **Programming Language:** PHP 8.1
- **API Testing Tool:** Postman

---

## **API Endpoints**

### **1. Store Entity Thread**  

**Endpoint:** `POST /api/store-entity-thread`  
**Description:** Saves an `EntityThread` document in MongoDB.  

**Request Body Parameters:**  
| Field            | Type    | Required | Description                              |
|-------------------|---------|----------|------------------------------------------|
| `name`           | string  | Yes      | Name of the entity thread.              |
| `created_by`     | integer | Yes      | ID of the user creating the thread.     |
| `entity_id`      | integer | Yes      | Associated entity ID.                   |
| `item_id`        | integer | Yes      | Associated item ID.                     |
| `creator_role_id`| integer | Yes      | Role ID of the creator.                 |
| `sent`           | integer | Yes      | Status (`0`, `1`, or `2`).              |
| `reason`         | string  | No       | Reason for the thread.                  |
| `original_body`  | string  | No       | Content of the thread.                  |
| `record_status`  | string  | No       | Record status (e.g., "A" or "I").       |

**Response Example:**  
```json
{
    "message": "EntityThread saved successfully!",
    "inserted_id": "647f14ac1c5f1c23c87e43ab"
}
```

---

### **2. Store Message**

**Endpoint:** `POST /api/store-message`  
**Description:** Saves a `Message` document associated with an entity thread in MongoDB.  

**Request Body Parameters:**  
| Field               | Type    | Required | Description                     |
|----------------------|---------|----------|---------------------------------|
| `user_id`           | integer | Yes      | ID of the user sending the message.  |
| `entity_thread_id`  | integer | Yes      | ID of the associated thread.         |
| `flag`              | integer | Yes      | Status flag (`0` or `1`).            |

**Response Example:**  
```json
{
    "message": "Message saved successfully!",
    "data": {
        "_id": "647f14df9b8f1c24c97e44cd",
        "user_id": 1,
        "entity_thread_id": 123,
        "flag": 1
    }
}
```

---

### **3. Ping MongoDB**

**Endpoint:** `GET /api/ping-mongo`  
**Description:** Tests the connection with the MongoDB database.  

**Response Example:**  
```json
{
    "message": "Pinged your deployment. You successfully connected to MongoDB!"
}
```

---

## **Setup Instructions**

### **1. Prerequisites**

- PHP >= 8.1
- Composer
- MongoDB installed or hosted (e.g., MongoDB Atlas)

### **2. Clone Repository**

```bash
git clone https://github.com/your-repo-name.git
cd your-repo-name
```

### **3. Install Dependencies**

```bash
composer install
```

### **4. Configure Environment Variables**

Update your `.env` file to include MongoDB connection details:

```dotenv
DB_MONGO_URI=mongodb+srv://<username>:<password>@<cluster>.mongodb.net/<database>?retryWrites=true&w=majority
DB_MONGO_DATABASE=<your-database-name>
```

### **5. Start Development Server**

```bash
php artisan serve
```

---

## **Testing the APIs**

1. **Using Postman:**  
   - Import the example requests provided above to test each endpoint.

2. **Example Postman Request for `store-entity-thread`:**  
   - **URL:** `http://127.0.0.1:8000/api/store-entity-thread`  
   - **Method:** `POST`  
   - **Headers:** `Content-Type: application/json`  
   - **Body (JSON):**  
     ```json
     {
         "name": "Thread Example",
         "created_by": 1,
         "entity_id": 123,
         "item_id": 456,
         "creator_role_id": 789,
         "sent": 1,
         "reason": "Example reason",
         "original_body": "Example body",
         "record_status": "A"
     }
     ```

3. **Example Postman Request for `store-message`:**  
   - **URL:** `http://127.0.0.1:8000/api/store-message`  
   - **Method:** `POST`  
   - **Headers:** `Content-Type: application/json`  
   - **Body (JSON):**  
     ```json
     {
         "user_id": 1,
         "entity_thread_id": 123,
         "flag": 1
     }
     ```

4. **Example Postman Request for `ping-mongo`:**  
   - **URL:** `http://127.0.0.1:8000/api/ping-mongo`  
   - **Method:** `GET`

---

