<?php use Fisharebest\Webtrees\Auth; ?>
<?php use Fisharebest\Webtrees\Bootstrap4; ?>
<?php use Fisharebest\Webtrees\Config; ?>
<?php use Fisharebest\Webtrees\FontAwesome; ?>
<?php use Fisharebest\Webtrees\Functions\FunctionsEdit; ?>
<?php use Fisharebest\Webtrees\GedcomTag; ?>
<?php use Fisharebest\Webtrees\I18N; ?>
<?php use Ramsey\Uuid\Uuid; ?>

<h2 class="wt-page-title"><?= $title ?></h2>

<form class="wt-page-content" action="<?= e(route('update-fact', ['ged' => $tree->getName(), 'xref' => $record->getXref()])) ?>" method="post">
	<?= csrf_field() ?>

	<?php FunctionsEdit::createAddForm($tree, $fact) ?>

	<?php if (($record::RECORD_TYPE === 'INDI' || $record::RECORD_TYPE === 'FAM') && $fact !== 'OBJE' && $fact !== 'NOTE' && $fact !== 'SHARED_NOTE' && $fact !== 'REPO' && $fact !== 'SOUR' && $fact !== 'SUBM' && $fact !== 'ASSO' && $fact !== 'ALIA' && $fact !== 'SEX'): ?>
		<?= view('cards/add-source-citation', [
			'level'          => 2,
			'full_citations' => $tree->getPreference('FULL_SOURCES'),
			'tree'           => $tree,
		]); ?>

		<?php if ($tree->getPreference('MEDIA_UPLOAD') >= Auth::accessLevel($tree)): ?>
			<?= view('cards/add-media-object', [
			'level' => 2,
			'tree' => $tree,
			]) ?>
		<?php endif ?>

		<?php if ($fact !== 'NOTE'): ?>
			<?= view('cards/add-note', [
				'level' => 2,
				'tree' => $tree,
			]) ?>

			<?= view('cards/add-shared-note', [
				'level' => 2,
				'tree' => $tree,
			]) ?>
		<?php endif ?>

		<?= view('cards/add-associate', [
			'id'    => Uuid::uuid4()->toString(),
			'level' => 2,
			'tree' => $tree,
		]) ?>
		<?php if (in_array($fact, Config::twoAssociates())): ?>
			<?= view('cards/add-associate', [
				'id'    => Uuid::uuid4()->toString(),
				'level' => 2,
				'tree' => $tree,
			]) ?>
		<?php endif ?>

		<?= view('cards/add-restriction', [
			'level' => 2,
			'tree' => $tree,
		]) ?>
	<?php endif ?>

	<div class="form-group row">
		<label class="col-sm-3 col-form-label" for="keep_chan">
			<?= I18N::translate('Last change') ?>
		</label>
		<div class="col-sm-9">
			<?= Bootstrap4::checkbox(I18N::translate('Keep the existing “last change” information'), true, ['name' => 'keep_chan', 'checked' => (bool) $tree->getPreference('NO_UPDATE_CHAN')]) ?>
			<?= GedcomTag::getLabelValue('DATE', $record->lastChangeTimestamp()) ?>
			<?= GedcomTag::getLabelValue('_WT_USER', e($record->lastChangeUser())) ?>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-3 wt-page-options-label">
		</div>
		<div class="col-sm-9 wt-page-options-value">
			<button class="btn btn-primary" type="submit">
				<?= FontAwesome::decorativeIcon('save') ?>
				<?= /* I18N: A button label. */
				I18N::translate('save') ?>
			</button>
			<a class="btn btn-secondary" href="<?= e($record->url()) ?>">
				<?= FontAwesome::decorativeIcon('cancel') ?>
				<?= /* I18N: A button label. */
				I18N::translate('cancel') ?>
			</a>
		</div>
	</div>
</form>

<?= view('modals/on-screen-keyboard') ?>
<?= view('modals/ajax') ?>
<?= view('edit/initialize-calendar-popup') ?>
