</div>
    <div class="modal fade" id="book-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-med">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Book Details</h4>
                </div>
                <div class="modal-body">
                    !!Output Goes Here!!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>js/modalViewer.js"></script>
    <script src="<?php echo base_url();?>js/easteregg.js"></script>
    <style type="text/css">
        table.modal-data {
            width: 100%;
            margin-bottom: 0;
        }
        table.modal-data td {
            width: 50%;
        }
        table.modal-data td:nth-child(odd) {
            text-align: right;
        }
        table.modal-data td:nth-child(even) {
            text-align: left;
        }
        .modal-med {
            width: 480px;
        }
    </style>

</div>
</body>
</html>