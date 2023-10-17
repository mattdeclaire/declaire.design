const recaptcha_key = document.querySelector('meta[name=recaptcha_key]').content;

$('input[name=recaptcha]', input => {
    const form = input.closest('form');

    form.addEventListener('submit', event => {
        event.preventDefault();

        grecaptcha.ready(() => {
            grecaptcha.execute(recaptcha_key, {action: 'submit'})
                .then(token => {
                    input.value = token;
                    form.submit();
                });
        });
    });
});
