<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Interview Schedule')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Home")); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__("Interview Schedule")); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>

    <script type="text/javascript">
        (function() {
            var etitle;
            var etype;
            var etypeclass;
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth'
                },
                buttonText: {
                    timeGridDay: "<?php echo e(__('Day')); ?>",
                    timeGridWeek: "<?php echo e(__('Week')); ?>",
                    dayGridMonth: "<?php echo e(__('Month')); ?>"
                },
                themeSystem: 'bootstrap',

                slotDuration: '00:10:00',
                navLinks: true,
                droppable: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events: <?php echo $arrSchedule; ?>,


            });

            calendar.render();
        })();
    </script>
    <script>
        // var Fullcalendar = function() {
        //     var e, t, a = $('[data-toggle="schedule_calendar"]');
        //     a.length && (t = {
        //         header: {
        //             right: "",
        //             center: "",
        //             left: ""
        //         },
        //         buttonIcons: {
        //             prev: "calendar--prev",
        //             next: "calendar--next"
        //         },
        //         theme: !1,
        //         selectable: !0,
        //         selectHelper: !0,
        //         editable: !1,
        //         events: <?php echo $arrSchedule; ?>,
        //         dayClick: function(e) {
        //             var t = moment(e).toISOString();
        //             $("#new-event").modal("show"), $(".new-event--title").val(""), $(".new-event--start")
        //                 .val(t), $(".new-event--end").val(t)
        //         },
        //         viewRender: function(t) {
        //             e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
        //         },
        //         eventClick: function(e, t) {
        //             var title = e.title;
        //             var url = e.url;


        //             if (typeof url != 'undefined') {
        //                 $("#commonModal .modal-title").html('Interview Schedule Details');
        //                 $("#commonModal .modal-dialog").addClass('modal-md');
        //                 $("#commonModal").modal('show');
        //                 $.get(url, {}, function(data) {

        //                     $('#commonModal .modal-body').html(data);
        //                 });
        //                 return false;
        //             }
        //         }
        //     }, (e = a).fullCalendar(t), $("body").on("click", ".new-event--add", function() {
        //         var t = $(".new-event--title").val(),
        //             a = {
        //                 Stored: [],
        //                 Job: function() {
        //                     var e = Date.now().toString().substr(6);
        //                     return this.Check(e) ? this.Job() : (this.Stored.push(e), e)
        //                 },
        //                 Check: function(e) {
        //                     for (var t = 0; t < this.Stored.length; t++)
        //                         if (this.Stored[t] == e) return !0;
        //                     return !1
        //                 }
        //             };
        //         "" != t ? (e.fullCalendar("renderEvent", {
        //             id: a.Job(),
        //             title: t,
        //             start: $(".new-event--start").val(),
        //             end: $(".new-event--end").val(),
        //             allDay: !0,
        //             className: $(".event-tag input:checked").val()
        //         }, !0), $(".new-event--form")[0].reset(), $(".new-event--title").closest(
        //             ".form-group").removeClass("has-danger"), $("#new-event").modal("hide")) : ($(
        //             ".new-event--title").closest(".form-group").addClass("has-danger"), $(
        //             ".new-event--title").focus())
        //     }), $("body").on("click", "[data-calendar]", function() {
        //         var t = $(this).data("calendar"),
        //             a = $(".edit-event--id").val(),
        //             n = $(".edit-event--title").val(),
        //             o = $(".edit-event--description").val(),
        //             i = $("#edit-event .event-tag input:checked").val(),
        //             s = e.fullCalendar("clientEvents", a);
        //         "update" === t && ("" != n ? (s[0].title = n, s[0].description = o, s[0].className = [i],
        //             console.log(i), e.fullCalendar("updateEvent", s[0]), $("#edit-event").modal(
        //                 "hide")) : ($(".edit-event--title").closest(".form-group").addClass(
        //             "has-error"), $(".edit-event--title").focus())), "delete" === t && ($("#edit-event")
        //             .modal("hide"), setTimeout(function() {
        //                 swal({
        //                     title: "Are you sure?",
        //                     text: "You won't be able to revert this!",
        //                     type: "warning",
        //                     showCancelButton: !0,
        //                     buttonsStyling: !1,
        //                     confirmButtonClass: "btn btn-danger",
        //                     confirmButtonText: "Yes, delete it!",
        //                     cancelButtonClass: "btn btn-secondary"
        //                 }).then(function(t) {
        //                     t.value && (e.fullCalendar("removeEvents", a), swal({
        //                         title: "Deleted!",
        //                         text: "The event has been deleted.",
        //                         type: "success",
        //                         buttonsStyling: !1,
        //                         confirmButtonClass: "btn btn-primary"
        //                     }))
        //                 })
        //             }, 200))
        //     }), $("body").on("click", "[data-calendar-view]", function(t) {
        //         t.preventDefault(), $("[data-calendar-view]").removeClass("active"), $(this).addClass(
        //             "active");
        //         var a = $(this).attr("data-calendar-view");
        //         e.fullCalendar("changeView", a)
        //     }), $("body").on("click", ".fullcalendar-btn-next", function(t) {
        //         t.preventDefault(), e.fullCalendar("next")
        //     }), $("body").on("click", ".fullcalendar-btn-prev", function(t) {
        //         t.preventDefault(), e.fullCalendar("prev")
        //     }))
        // }()

        $(document).on('change', '.stages', function() {
            var id = $(this).val();
            var schedule_id = $(this).attr('data-scheduleid');

            $.ajax({
                url: "<?php echo e(route('job.application.stage.change')); ?>",
                type: 'POST',
                data: {
                    "stage": id,
                    "schedule_id": schedule_id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    console.log(data);
                    show_toastr('success', data.success, 'success');
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 1000);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Interview Schedule')): ?>
        

        <a href="#" data-url="<?php echo e(route('interview-schedule.create')); ?>" data-ajax-popup="true"
        data-title="<?php echo e(__('Create New Interview Schedule')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
        data-bs-original-title="<?php echo e(__('Create')); ?>">
        <i class="ti ti-plus"></i>
    </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Calendar')); ?></h5>
            </div>
            <div class="card-body">
                <div id='calendar' class='calendar'></div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">

        <div class="card">
            <div class="card-body">

                <h4 class="mb-4"><?php echo e(__('Schedule List')); ?></h4>
                <ul class="event-cards list-group list-group-flush mt-3 w-100">
                    <li class="list-group-item card mb-3">
                    <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row align-items-center justify-content-between">
                           <div class=" align-items-center">
                             <div class="card mb-3 border shadow-none">
                                <div class="px-3">
                                    <div class="row align-items-center">
                                        
                                        <div class="col ml-n2 text-sm mb-0 fc-event-title-container">
                                                <h5 class="tcard-text small text-primary"><?php echo e(!empty($schedule->applications) ? (!empty($schedule->applications->jobs) ? $schedule->applications->jobs->title : '') : ''); ?></h5>
                                                <div class="card-text small text-dark"><?php echo e(!empty($schedule->applications) ? $schedule->applications->name : ''); ?>

                                                </div>
                                                <div class="card-text small text-dark"><?php echo e(\Auth::user()->dateFormat($schedule->date) . ' ' . \Auth::user()->timeFormat($schedule->time)); ?>

                                                </div>
                                        </div>
                                    
                               




                                <div class="col-auto text-right">
                                    <div class="d-inline-flex mb-4">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Interview Schedule')): ?>
                                                 <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                    data-url="<?php echo e(route('interview-schedule.edit', $schedule->id)); ?>"
                                                    data-ajax-popup="true" data-title="<?php echo e(__('Edit ')); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Interview Schedule')): ?>
                                           <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['interview-schedule.destroy', $schedule->id], 'id' => 'delete-form-' . $schedule->id]); ?>

                                                <a href="#!" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="<?php echo e(__('Delete')); ?>">
                                                    <i class="ti ti-trash text-white"></i></a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                          
                                        <?php endif; ?>
                                           


                                    </div>
                                </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </li>

                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

    

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newaccounts\resources\views/interviewSchedule/index.blade.php ENDPATH**/ ?>