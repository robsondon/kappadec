
    <script type="text/javascript">
        $(function() {
            $('.toggle-element').click(function() {
                var val = ($(this).data('value'));
                var targeturl = $(this).data('rel') + '?id=' + 1;
                var container = $(this);
                $.ajax({
                    data: {
                        id: 1,
                    },
                    type: 'post',
                    url: targeturl,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                        container.html(response.content);
                        container.data('value', response);

                    },
                    error: function(e) {
                        alert("An error occurred: " + e.responseText);
                        console.log(e);
                    }
                });
            });

        });
    </script>
    <h3><?= __('Users') ?></h3>
    

    <div class="page index">
    <div class="toggle">
        <div id="example-container">
            <span class="toggle-element" data-value="0" data-rel="<?php echo $this->Url->build(['_ext' => 'json']); ?>"><?php echo $users->role == false ? "Não é adm" : "Admin"; ?></span>
        </div>
    </div>
        </div>


    



