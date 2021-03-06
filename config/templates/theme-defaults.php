<?php
/**
 * @author Björn Schießle <schiessle@owncloud.com>
 * @author Jan-Christoph Borchardt, http://jancborchardt.net
 * @copyright Copyright (c) 2018, ownCloud GmbH
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 */
 
/* Thanks to the authors, this version is modified to use own values and rotating changing images (by C. Kloth) */

class OC_Theme {

	/**
	 * Returns the base URL
	 * @return string URL
	 */
	public function getBaseUrl() {
		return '${THEME_URL}';
	}

	/**
	 * Returns the URL where the sync clients are listed
	 * @return string URL
	 */
	public function getSyncClientUrl() {
		return 'https://owncloud.org/install';
	}

	/**
	 * Returns the URL to the App Store for the iOS Client
	 * @return string URL
	 */
	public function getiOSClientUrl() {
		return 'https://itunes.apple.com/us/app/owncloud/id543672169?mt=8';
	}

	/**
	 * Returns the AppId for the App Store for the iOS Client
	 * @return string AppId
	 */
	public function getiTunesAppId() {
		return '543672169';
	}

	/**
	 * Returns the URL to Google Play for the Android Client
	 * @return string URL
		 */
	public function getAndroidClientUrl() {
		return 'https://play.google.com/store/apps/details?id=com.owncloud.android';
	}

	/**
	 * Returns the documentation URL
	 * @return string URL
	 */
	public function getDocBaseUrl() {
		return 'https://doc.owncloud.org';
	}

	/**
	 * Returns the title
	 * @return string title
	 */
	public function getTitle() {
		return '${THEME_TITLE}';
	}

	/**
	 * Returns the short name of the software
	 * @return string title
	 */
	public function getName() {
		return '${THEME_NAME}';
	}

	/**
	 * Returns the short name of the software containing HTML strings
	 * @return string title
	 */
	public function getHTMLName() {
		return '${THEME_NAME}';
	}

	/**
	 * Returns entity (e.g. company name) - used for footer, copyright
	 * @return string entity name
	 */
	public function getEntity() {
		return '${THEME_ENTITY}';
	}

	/**
	 * Returns slogan
	 * @return string slogan
	 */
	public function getSlogan() {
		return '${THEME_SLOGAN}';
	}

	/**
	 * Returns logo claim
	 * @return string logo claim
	 */
	public function getLogoClaim() {
		return '<a href="${THEME_URL}">${THEME_SLOGAN}</a>';
	}

	public function getPrivacyPolicyUrl() {
		try {
			return \OC::${D}server->getConfig()->getAppValue('core', 'legal.privacy_policy_url', '');
		} catch (\Exception ${D}e) {
			return '';
		}
	}
	
	public function getImprintUrl() {
		try {
			return \OC::${D}server->getConfig()->getAppValue('core', 'legal.imprint_url', '');
		} catch (\Exception ${D}e) {
			return '';
		}
	}

	public function getL10n() {
		return \OC::${D}server->getL10N('core');
	}
	
	/**
	 * Returns short version of the footer
	 * @return string short footer
	 */
	public function getShortFooter() {
		${D}l10n = ${D}this->getL10n();
		${D}footer = '© ${THEME_YEAR} <a href="'.${D}this->getBaseUrl().'" target="_blank\">'.${D}this->getEntity().'</a>'.
			'<br/>' . ${D}this->getSlogan();
		if (${D}this->getImprintUrl() !== '') {
			${D}footer .= '<span class="nowrap"> | <a href="' . ${D}this->getImprintUrl() . '" target="_blank">' . ${D}l10n->t('Imprint') . '</a></span>';
		}

		if (${D}this->getPrivacyPolicyUrl() !== '') {
			${D}footer .= '<span class="nowrap"> | <a href="'. ${D}this->getPrivacyPolicyUrl() .'" target="_blank">'. ${D}l10n->t('Privacy Policy')	 .'</a></span>';
		}
		return ${D}footer;
	}

	/**
	 * Returns long version of the footer
	 * @return string long footer
	 */
	public function getLongFooter() {
		${D}l10n = ${D}this->getL10n();
		${D}footer = '© ${THEME_YEAR} <a href="'.${D}this->getBaseUrl().'" target="_blank\">'.${D}this->getEntity().'</a>'.
			'<br/>' . ${D}this->getSlogan();
		if (${D}this->getImprintUrl() !== '') {
			${D}footer .= '<span class="nowrap"> | <a href="' . ${D}this->getImprintUrl() . '" target="_blank">' . ${D}l10n->t('Imprint') . '</a></span>';
		}

		if (${D}this->getPrivacyPolicyUrl() !== '') {
			${D}footer .= '<span class="nowrap"> | <a href="'. ${D}this->getPrivacyPolicyUrl() .'" target="_blank">'. ${D}l10n->t('Privacy Policy') .'</a></span>';
		}
		return ${D}footer;
	}

	public function buildDocLinkToKey(${D}key) {
		return ${D}this->getDocBaseUrl() . '/server/10.0/go.php?to=' . ${D}key;
	}


	/**
	 * Returns mail header color
	 * @return string
	 */
	public function getMailHeaderColor() {
		return '#745bca';
	}

}
