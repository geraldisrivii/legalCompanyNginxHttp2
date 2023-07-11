<?php
    global $template;
    $basename = basename($template, '.php');
?>

<script>
    let catalogButtons = document.querySelectorAll('.catalog-item__button');

    for (const button of catalogButtons) {
        button.addEventListener('click', async () => {
            Swal.fire({
                icon: 'info',
                title: 'Введите данные',
                html: `<form action="<?= admin_url('admin-ajax.php'); ?>" id="${button.id}" class="alert-form form-consult">
                    <?php
                        $regexpArray = [];
                        $dataTitleFields = null;
                        $dataTitleButton = null;
                        switch ($basename) {
                            case 'catalog':
                                $dataTitleFields =  'section_2_form_fields';
                                $dataTitleButton = 'section_2_button';
                               break;
                            case 'index':
                                $dataTitleFields =  'section_5_form_fields';
                                $dataTitleButton = 'section_5_button';
                                break;
                        }
                        $formFields = CFS()->get($dataTitleFields ?? 'section_2_form_fields');
                        foreach ($formFields as $key => $field) {
                            $field = (object)$field;
                            $regexpArray[$field->name] = $field->regexp;
                            ?>
                            <input class="form-consult__input" placeholder="<?= $field->placeholder ?>" type="<?= $field->type ?>" name="<?= $field->name ?>">
                            <?php
                        }
                    ?>
                    <?php
                        $regexpArray['service_id'] = '/[0-9]+/';
                    ?>
                    <input type="hidden" name="service_id" value='${button.id}'>
                    <input type="hidden" name="regexp" value='<?= json_encode($regexpArray, JSON_UNESCAPED_UNICODE) ?>'>
                    <input type="hidden" name="action" value="add_bid_action_ajax">
                    <?php wp_nonce_field('my-ajax-nonce', 'ajax_nonce'); ?>
                </form>`,
                confirmButtonText: '<?= CFS()->get($dataTitleButton) ?>' 
            }).then(async (result) => {
                if(result.isConfirmed){
                    var submitEvent = new Event('submit');

                    // Выполнение обработчика события submit
                    document.querySelector('.alert-form').dispatchEvent(submitEvent);
                };
            });
            let form = document.querySelector('.alert-form');

            form.onsubmit =  async (e) => {
                e.preventDefault();
                console.log(form.getAttribute('action'));
                let formData = new FormData(form);
                fetch(form.getAttribute('action'), {
                    method: 'POST',
                    body: formData
                }).then((data) => {
                    return data.json();
                }).then((data) => {
                    Swal.fire({
                        icon: data.status == 'ok' ? 'success' : 'error',
                        title: data.message,
                    })
                    console.log(data)
                })
            }
        })
    }
</script>