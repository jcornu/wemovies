    document.addEventListener('DOMContentLoaded', function () {
        function openModal(movieId) {
            const movieModal = document.querySelector('#movie-modal');
            movieModal.setAttribute('data-movie-id', movieId);

            fetch(`/api/movies/${movieId}`)
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    const movieDetails = data;

                    document.querySelector('.modal-title').textContent = movieDetails.title;

                    const youtubeVideoIframe = document.getElementById('modal-youtube-video');
                    youtubeVideoIframe.src = `https://www.youtube.com/embed/${movieDetails.videoUrl}`;

                    document.querySelector('.modal-description').textContent = movieDetails.description;

                    document.getElementById('movie-modal').style.display = 'block';
                })
                .catch(function (error) {
                    console.error('Erreur lors de l\'appel API :', error);
                });
        }

        function closeModal() {
            document.getElementById('movie-modal').style.display = 'none';
        }

        document.querySelector('#close-modal-button').addEventListener('click', function () {
            closeModal();
        });

        document.querySelector('#movies-grid').addEventListener('click', function (event) {
            const movie = event.target.closest('li');

            if (movie) {
                const movieId = movie.getAttribute('data-id');
                openModal(movieId);
                console.log('clicked', movieId);
            }
        });
});
