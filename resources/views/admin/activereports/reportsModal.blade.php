<div class="modal fade static-modal" id="viewReportsModal" tabindex="-1" aria-labelledby="viewGuidelinesModal" aria-hidden="true">
    <div class="modal-dialog modal-xs modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 border rounded p-3">
                    <div class="mb-3 d-flex justify-content-center">
                        <div id="profile_image"><img style="width: 200px;height:auto;" class="rounded" src="https://t3.ftcdn.net/jpg/05/16/27/58/360_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"></div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Report ID:</label>
                        <span id="report_id"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Resident Name:</label>
                        <div id="resident_name"></div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Date and Time:</label>
                        <span id="date_time"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Emergency Type:</label>
                        <span id="emergency_type"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Location:</label>
                        <span id="location"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Location Link:</label>
                        <div id="location_link"></div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Phone Number:</label>
                        <span id="phone_number"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Message:</label>
                        <span id="message"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Image Evidence:</label>
                        <div id="image_evidence"></div>
                    </div>
                </div>
                <button type="button" id="acceptReportBtn" class="btn btn-primary">Accept</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade static-modal" id="viewAcceptedReportsModal" tabindex="-1" aria-labelledby="viewGuidelinesModal" aria-hidden="true">
    <div class="modal-dialog modal-xs modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Accepted Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 border rounded p-3">
                    <div class="mb-3 d-flex justify-content-center">
                        <div id="profile_image"><img style="width: 200px;height:auto;" class="rounded" src="https://t3.ftcdn.net/jpg/05/16/27/58/360_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"></div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Report ID:</label>
                        <span id="report_id"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Resident Name:</label>
                        <div id="resident_name"></div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Date and Time:</label>
                        <span id="date_time"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Emergency Type:</label>
                        <span id="emergency_type"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Location:</label>
                        <span id="location"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Location Link:</label>
                        <div id="location_link"></div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Phone Number:</label>
                        <span id="phone_number"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Message:</label>
                        <span id="message"></span>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Image Evidence:</label>
                        <div id="image_evidence"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        function resetForm(formId) {
            $(formId)[0].reset();
            $(formId + ' .text-danger').text('');
        }

        $('.static-modal').modal({
            backdrop: 'static',
            keyboard: false
        });

        // $('#viewReportsModal').on('hidden.bs.modal', function() {
        //     resetForm('#addGuidelinesForm');
        //     clearPreviews();
        // });


        $('#acceptReportBtn').on('click', function() {
            var reportsId = $("#viewReportsModal #report_id").text();
        
            $.ajax({
                type: 'PATCH',
                url: "{{ url('admin/reports') }}/" + reportsId,
                // data: updateFormData,
                success: function(response) {
                    toastr.success('Report Accepted!');
                    $('#viewReportsModal').modal('hide');
                    var oTable = $('#report-table').dataTable();
                    oTable.fnDraw(false);
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                }
            });
        });


    });
</script>