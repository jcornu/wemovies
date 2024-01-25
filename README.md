To run the project make sure you have docker & docker-compose installed.

### Installation

Then you just have to run 
```
cd infra
docker-compose up -d --build
docker-compose run php composer install
```

### Configuration

Do not forget to create a .env.local in `symfony` folder and filled your TMDB api key

```
TMDB_API_KEY=YOUR_KEY_HERE
```
![screen 1](https://github.com/jcornu/wemovies/assets/4135367/dc51da32-75f1-4358-bee4-f70914eaae34)

![screen 2](https://github.com/jcornu/wemovies/assets/4135367/a96cbe0e-bbb1-4780-8695-7581297235f0)
