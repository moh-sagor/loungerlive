
const deleteButtons = document.querySelectorAll('.delete-btn');
deleteButtons.forEach((button) => {
    button.addEventListener('click', function (event) {
        event.preventDefault(); // prevent form submission

        // const userId = this.getAttribute('data-user-id');
        const form = this.closest('form'); // Get the parent form of the button
        // const urlToRedirect = form.getAttribute('action');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});


