<?php
$menudisp = "Product";
include "includes/header.php";
include "includes/Mdme-functions.php";
$mdme = getMdmenews($db, '');
include_once "includes/pagepermission.php";
//check permission - START
if (!($res_modm_prm)) {
    header("Location:" . admin_public_url . "error.php");
}
//check permission - END

$getsize = getimagesize_large($db, 'product', 'product_image');
$imageval = explode('-', $getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

$id = $_REQUEST['id'];
$view = $_REQUEST['id'];
$countgetimages = $db->get_var("select count(*) from kr_product_images where product_id='" . $view . "'");
?>
<?php include "common/dpselect-functions.php"; ?>
<?php include "includes/top.php"; ?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="cs-overlay"></div>

    <!--  BEGIN SIDEBAR  -->

    <?php include "includes/sidebar.php"; ?>

    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h3>Product Image</h3>
                    <div class="crumbs">
                        <ul id="breadcrumbs" class="breadcrumb">
                            <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
                            <li><a href="#">Media</a></li>
                            <li><a href="product_mng.php">Product Image More Images</a></li>
                            <li class="active"><a href="#"><?php echo $operation; ?> Product Image More Images</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4><?php echo $operation; ?> Product Image More Images</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <form id="jvalidate" name="frmProductimage" role="form" class="form-horizontal"
                                        action="#" method="post" enctype='multipart/form-data'>
                                        <input type="hidden" name="action" value="moreimage" />
                                        <input type="hidden" name="edit_id" value="<?php echo $view; ?> " />
                                        <div class="row">
                                            <div class="col col col-md-3">
                                                <div class="control-group mb-4">
                                                    <label class="control-label">Choose Color </label>
                                                </div>
                                            </div>
                                            <div class="col col col-md-6">
                                                <div class="control-group mb-4">
                                                    <div class="controls">
                                                        <?php
                                                        //echo "select group_concat(colorid) as colorids from kr_product_attribute_multiple where product_id = '".$_REQUEST['id']."' and IsActive = 1 and lang_id = 1";
                                                        $getproductcolorid = $db->get_a_line("select group_concat(colorid) as colorids from kr_product_attribute_multiple where product_id = '" . $_REQUEST['id'] . "' and IsActive = 1 and lang_id = 1");
                                                        //echo $getproductcolorid['colorids']."dsf";
                                                        echo getattributemasterdata($db, 'colorid', 'jrequired', '', '', '5', $getproductcolorid['colorids']); ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 control-label">Images<span
                                                    class="reqfield">*</span></label>
                                            <div class="col-sm-9 mb-4">
                                                <div class="form-upload product_img">
                                                    <div class="dropzone" id="dropzone">
                                                        <input class="product_images" id="productimage" required
                                                            name="productimage[]" type="file" fi-type=""
                                                            multiple="multiple">
                                                    </div>
                                                    <small>Image file extension jpg, jpeg, gif, png and Image size (
                                                        <?php echo $imgwidth . '*' . $imgheight; ?>) </small>
                                                </div>
                                                <div class="form-upload" id="uploadedProducts"> </div>
                                            </div>
                                        </div>





                                        <div class="row">
                                            <div class="col col-md-3">
                                                <div class="control-group mb-4"> &nbsp; </div>
                                            </div>
                                            <div class="col col-md-6">
                                                <div class="control-group mb-4">
                                                    <div class="controls">

                                                        <button type="button"
                                                            class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"
                                                            onClick="javascript:funSubmtWithImg('frmProductimage','product_actions.php','jvalidate','productimages','product_moreimage.php?id=<?php echo $view; ?>');">Upload</button>

                                                        <button type="button"
                                                            class="btn btn-dark btn-rounded snackbar-bg-dark mb-4"
                                                            onClick="javascript:funCancel('frmProductimage','jvalidate','Product','product_mng.php');">Cancel</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <fieldset>
                                <legend></legend>
                                <form class="form-horizontal" action="product_actions.php" id="jvalidate1" name="noimg"
                                    method="post">
                                    <input type="hidden" value="moreimageupdate" name="action" id="action">
                                    <input type="hidden" value="<?php echo $view; ?>" name="edit_id" id="edit_id">

                                    <div class="box">
                                        <div class="box-body">
                                            <table id="tblresult" class="table  table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>Color</th>
                                                        <th>Image</th>
                                                        <th>Sort</th>
                                                        <th>Default Image</th>
                                                        <th align="center">Status</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($countgetimages > 0) {
                                                        $j = 1;
                                                        $check = '';


                                                        $getallimg = $db->get_rsltset("select a.*,d.dropdown_values from  kr_product_images a inner join kr_dropdown d on d.dropdown_id = a.colorid where a.product_id='$view' and a.IsActive = 1 and a.lang_id = 1 order by a.product_img_id asc");

                                                        $getimg1 = $db->get_a_line("select group_concat(product_img_id) as product_img_id from kr_product_images where product_id='$view' and IsActive = 1  and lang_id = 1 order by product_img_id asc");

                                                        foreach ($getallimg as $getimg) {
                                                            $i = $getimg['product_img_id'];
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $j; ?></td>
                                                        <td><?php echo $getimg['dropdown_values']; ?></td>
                                                        <td>
                                                            <?php if ($getimg['img_path'] != "") {
                                                                    ?>
                                                            <img width="50"
                                                                src="<?php echo IMG_BASE_URL . "productassest/" . $view . "/photos/" . $getimg['img_path']; ?>" />
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="productimgid"
                                                                id="productimgid<?php echo $getimg['product_img_id']; ?>"
                                                                value="<?php echo $getimg1['product_img_id']; ?>" />
                                                            <input type="text" maxlength="3"
                                                                onkeypress="return CheckNumericKeyInfowithoutDot(event.keyCode, event.which);"
                                                                name="image1order<?php echo $getimg['product_img_id']; ?>"
                                                                id="image1order<?php echo $getimg['product_img_id']; ?>"
                                                                placeholder="Image Sort order" class="form-control"
                                                                value="<?= $getimg['ordering'] ?>" />
                                                        </td>
                                                        <td>
                                                            <input name="isbasedefault" <?php if ($getimg['isbasedefault'] == 1) {echo $check = "checked";} ?>
                                                            id="modules-<?php echo $getimg['product_img_id']; ?>"
                                                            value="<?php echo $getimg['product_img_id']; ?>" type="radio">
                                                        </td>

                                                        <td align="center">
                                                            <input name="status<?php echo $getimg['product_img_id']; ?>"
                                                                <?php if ($getimg['IsActive'] == 1) {
                                                                                                                                        echo $check = "checked";
                                                                                                                                    } ?>
                                                                id="modules-<?php echo $getimg['product_img_id']; ?>"
                                                                value="1" type="checkbox">
                                                            <input type="hidden"
                                                                name="image<?php echo $getimg['product_img_id']; ?>id"
                                                                id="image<?php echo $getimg['product_img_id']; ?>id"
                                                                placeholder="Image Sort order" class="form-control"
                                                                value="<?= $getimg['product_img_id'] ?>" />
                                                        </td>


                                                        <td class="center">
                                                            <input class='product_image_del'
                                                                name="imagestatus<?php echo $getimg['product_img_id']; ?>"
                                                                <?php echo $imgcheck; ?>
                                                                id="modules-<?php echo $getimg['product_img_id']; ?>"
                                                                value="1" type="checkbox">
                                                            <input type="hidden"
                                                                name="productim<?php echo $getimg['product_img_id']; ?>"
                                                                value="<?php echo $getimg['img_path']; ?>" />
                                                            <input
                                                                name="img_path<?php echo $getimg['product_img_id']; ?>"
                                                                value="<?php echo root; ?>uploads/news/<?php echo $getimg['img_path']; ?>"
                                                                type="hidden">
                                                        </td>
                                                    </tr>
                                                    <?php $j++;
                                                        } ?>
                                                    <?php
                                                    } else { ?>
                                                    <td colspan="6" align="center">No News Image Found</td>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    <!-- Button (Double) -->
                                    <?php if ($countgetimages > 0) { ?>
                                    <div class="form-group">
                                        <label class="col-lg-9 control-label" for="submit"></label>
                                        <div class="col-lg-3">
                                            <button class="btn bg-purple margin" type="reset"
                                                onClick="javascript:funCancel('noimg','jvalidate1','moreimageupdate','product_mng.php');">Cancel</button>
                                            <!-- <input type="submit" class="btn bg-maroon margin pull-right" value="Update" />-->
                                            <button class="btn bg-maroon margin pull-right" type="button"
                                                onClick="javascript:funSubmt('noimg','product_actions.php','jvalidate1','moreimageupdate','product_moreimage.php?id=<?php echo $view; ?>');">

                                                <span id="spSubmit"><i class="fa fa-save"></i> Update</span></button>

                                        </div>
                                    </div>
                                    <?php } ?>
                                </form>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT PART  -->
</div>
<!-- END MAIN CONTAINER -->

<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php'); ?>

<script>
jQuery(document).ready(function() {


    $("#productimage").filer({
        limit: null,
        maxSize: null,
        addMore: true,
        extensions: ['jpg', 'jpeg', 'png', 'gif'],
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
            itemAppend: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            canvasImage: true,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        dragDrop: {
            dragEnter: null,
            dragLeave: null,
            drop: null,
            dragContainer: null,
        }
    });
});
</script>