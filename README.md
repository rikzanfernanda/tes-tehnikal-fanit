# Tes Tehnikal - Rikzan Fernanda (Back End Developer)

## Tes Logika
### How to run
1. move to ```tes-logika``` directory
2. ```npm i```
3. Run testing using ```npm test```

## Tes Logika Versi Python
### How to Run
1. move to ```tes-logika-python``` directory
2. Run ```python countSockPairs.py```
3. Run ```python countWords.py```

## App - Restful API
### How to Set up
1. move to ```app``` directory
2. Setup ```.env``` file
3. Set database connection with PostgreSQL database
4. Run ```php artisan jwt:secret```
5. Run ```php artisan migrate```
6. Run ```php artisan db:seed```

### Testing API
1. Setup ```.env.testing``` file (copy from .env file with different database)
2. Run ```php artisan test```

### Endpoint API
#### 1. Login
- ```/api/login```
- Metode: POST
- Authorization: no
- Body (e.g):
```json
{
    "email": "bayu@gmail.com",
    "password": "12345"
}
```

#### 2. Create Presences/Absensi
- ```/api/presences```
- Metode: POST
- Authorization: yes
- Body (e.g):
```json
"type": "IN",
"waktu": "2023-09-15 08:00:00"
```
#### 3. Approve Presences/Absensi
- ```/api/approve```
- Metode: POST
- Authorization: yes
- Body (e.g):
```json
"id_presences": 1,
"is_approve": 1
```

#### 4. Get Data Presences/Absensi
- ```/api/presences```
- Metode: GET
- Authorization: yes