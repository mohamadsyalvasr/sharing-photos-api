## API Documentation
Postman https://documenter.getpostman.com/view/7235534/2s93sabDiT
 
## Example Request
### Register
`curl --location 'http://127.0.0.1:8000/api/v1/register' \
--header 'Accept: application/json' \
--form 'name="syalva"' \
--form 'email="msyalva1@mail.com"' \
--form 'password="123456789"'`

### Login
`curl --location 'http://127.0.0.1:8000/api/v1/login' \
--header 'Accept: application/json' \
--form 'email="msyalva@mail.com"' \
--form 'password="123456789"'`

### Upload Photo
`curl --location 'http://127.0.0.1:8000/api/v1/photos' \
--header 'Accept: application/json' \
--form 'photo=@"(path-to-image)"' \
--form 'caption="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At varius vel pharetra vel turpis nunc."' \
--form 'tag[]="Gambar"'`

### Get All Photos
`curl --location 'http://127.0.0.1:8000/api/v1/photos' \
--header 'Accept: application/json'`

### Get Photo Details
`curl --location 'http://127.0.0.1:8000/api/v1/photos/1' \
--header 'Accept: application/json'`

### Update Photo Details
`curl --location 'http://127.0.0.1:8000/api/v1/photos/1' \
--header 'Accept: application/json' \
--form '_method="PUT"' \
--form 'caption="Mengubah Caption dan Tag"' \
--form 'tag[]="Gambar"'`

### Like Photo
`curl --location --request POST 'http://127.0.0.1:8000/api/v1/photos/1/like' \
--header 'Accept: application/json'`

### Unlike Photo
`curl --location --request POST 'http://127.0.0.1:8000/api/v1/photos/1/unlike' \
--header 'Accept: application/json'`

### Delete Photo
`curl --location --request DELETE 'http://127.0.0.1:8000/api/v1/photos/1' \
--header 'Accept: application/json'`

### Logout
`curl --location --request POST 'http://127.0.0.1:8000/api/v1/logout' \
--header 'Accept: application/json'`
