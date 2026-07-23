<?php $__env->startSection('panel'); ?>
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('S.N'); ?></th>
                                <th><?php echo app('translator')->get('User'); ?></th>
                                <th><?php echo app('translator')->get('Profile'); ?></th>
                                <?php if(request()->routeIs('admin.user.interests')): ?>
                                    <th><?php echo app('translator')->get('Accept Status'); ?></th>
                                <?php endif; ?>
                                <?php if(request()->routeIs('admin.user.reports')): ?>
                                    <th><?php echo app('translator')->get('Title'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <span class="fw-bold"><?php echo e($profiles->firstItem() + $loop->index); ?></span>
                                    </td>
                                    <?php if(request()->routeIs('admin.user.reports')): ?>
                                        <td>
                                            <span class="fw-bold"><?php echo e(@$profile->reporter->fullname); ?></span>
                                            <br>
                                            <span class="small"> <a href="<?php echo e(route('admin.users.detail', $profile->user_id)); ?>"><span>@</span><?php echo e(@$profile->reporter->username); ?></a> </span>
                                        </td>
                                    <?php else: ?>
                                        <td>
                                            <span class="fw-bold"><?php echo e(@$profile->user->fullname); ?></span>
                                            <br>
                                            <span class="small"> <a href="<?php echo e(route('admin.users.detail', $profile->user_id)); ?>"><span>@</span><?php echo e(@$profile->user->username); ?></a> </span>
                                        </td>
                                    <?php endif; ?>

                                    <td>
                                        <span class="fw-bold"><?php echo e(@$profile->profile->fullname); ?></span>
                                        <br>
                                        <span class="small"> <a href="<?php echo e(route('admin.users.detail', $profile->profile->id)); ?>"><span>@</span><?php echo e(@$profile->profile->username); ?></a> </span>
                                    </td>

                                    <?php if(request()->routeIs('admin.user.interests')): ?>
                                        <td>
                                            <?php echo $profile->statusBadge ?>
                                        </td>
                                    <?php endif; ?>
                                    <?php if(request()->routeIs('admin.user.reports')): ?>
                                        <td>
                                            <?php echo e(__($profile->title)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-wrap gap-2">
                                                <button class="detailBtn btn btn-outline--primary btn-sm" data-reason="<?php echo e(__($profile->reason)); ?>" data-title="<?php echo e(__($profile->title)); ?>"> <i class="las la-desktop"></i><?php echo app('translator')->get('Detail'); ?></button>

                                                <?php if($profile->profile->status == Status::USER_ACTIVE): ?>
                                                    <button class="btn btn-outline--danger userStatus btn-sm" data-user="<?php echo e($profile->profile); ?>" type="button"><i class="las la-ban"></i><?php echo app('translator')->get('Ban'); ?></button>
                                                <?php else: ?>
                                                    <button class="btn btn-outline--success userStatus btn-sm" data-user="<?php echo e($profile->profile); ?>" type="button"><i class="las la-undo"></i><?php echo app('translator')->get('Unban'); ?></button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <?php if($profiles->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($profiles)); ?>

                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>

    <div class="modal fade" id="detailModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Report!'); ?></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h5 class="title"></h5>
                    </div>
                    <p class="reason"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('Close'); ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userStatusModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="ban-div">
                            <h6 class="mb-2"><?php echo app('translator')->get('If you ban this user he/she won\'t able to access his/her dashboard.'); ?></h6>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Reason'); ?></label>
                                <textarea class="form-control" name="reason" required rows="4"></textarea>
                            </div>
                        </div>
                        <div class="banned-div">
                            <p><span><?php echo app('translator')->get('Ban reason was'); ?>:</span></p>
                            <p class="ban-reasn"></p>
                            <h4 class="mt-3 text-center"><?php echo app('translator')->get('Are you sure to unban this user?'); ?></h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 ban-div w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                        <div class="banned-div">
                            <button class="btn btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('No'); ?></button>
                            <button class="btn btn--primary" type="submit"><?php echo app('translator')->get('Yes'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <div class="d-flex justify-content-end flex-wrap">
        <form class="form-inline" action="" method="GET">
            <div class="input-group justify-content-end">
                <input class="form-control bg--white" name="search" type="text" value="<?php echo e(request()->search); ?>" placeholder="<?php echo app('translator')->get('Search Username'); ?>">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($q) {
            "use strict";
            $('.detailBtn').on('click', function() {
                let modal = $('#detailModal');
                let title = $(this).data('title');
                let reason = $(this).data('reason');

                modal.find('.title').text(title);
                modal.find('.reason').text(reason);
                modal.modal('show');
            });

            $('.userStatus').on('click', function() {
                let user = $(this).data('user');
                let modal = $('#userStatusModal');

                modal.find('form').attr('action', `<?php echo e(route('admin.users.status', '')); ?>/${user.id}`)

                if (user.status == 1) {
                    modal.find('.modal-title').text('Ban User');
                    modal.find('.banned-div').addClass('d-none');
                    modal.find('[name=reason]').attr('required', true);
                    modal.find('.ban-div').removeClass('d-none');
                } else {
                    modal.find('.modal-title').text('Unban User');
                    modal.find('.banned-div').removeClass('d-none');
                    modal.find('[name=reason]').attr('required', false);
                    modal.find('.ban-div').addClass('d-none');
                    modal.find('.ban-reasn').text(user.ban_reason);
                }

                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/users/interactions.blade.php ENDPATH**/ ?>