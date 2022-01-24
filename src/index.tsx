import { Placeholder, Snackbar, Spinner } from '@wordpress/components';
import { render, createContext, useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import './scss/index.scss';
import { ShowRinkerClasses } from './component/molecules/ShowRinkerClasses';
import { Toggle } from './component/molecules/Toggle';
import { Items } from './component/organisms/Items';
import { useGetApi } from './hooks/useGetApi';
import { apiContextType, noticeValueType } from './types/useContextType';

export const apiContext = createContext( {} as apiContextType );

const AdminPage = () => {
	const [ apiData, setApiData ] = useState( {} );
	const [ apiStatus, setApiStatus ] = useState( false );
	const [ noticeStatus, setNoticeStatus ] = useState( false );
	const [ noticeValue, setNoticeValue ] = useState(
		undefined as noticeValueType
	);
	const [ noticeMessage, setNoticeMessage ] = useState( '' );
	const [ snackbarTimer, setSnackbarTimer ] = useState(
		setTimeout( () => {} )
	);

	useGetApi( setApiData, setApiStatus );

	useEffect( () => {
		if ( noticeStatus ) {
			setSnackbarTimer(
				setTimeout( () => {
					setNoticeStatus( false );
				}, 4000 )
			);
		}
	}, [ noticeStatus ] );

	return (
		<div id="wrap">
			<h1>{ __( 'Ad Block Counter Settings', 'ad-block-counter' ) }</h1>
			{ noticeStatus && (
				<Snackbar className={ noticeValue }>{ noticeMessage }</Snackbar>
			) }
			{ apiStatus ? (
				<apiContext.Provider
					value={ {
						apiData,
						setApiData,
						setNoticeStatus,
						setNoticeValue,
						setNoticeMessage,
						snackbarTimer,
					} }
				>
					<Items
						title={ __( 'Use Rinker', 'ad-block-counter' ) }
						classValue="use-rinker"
					>
						<Toggle
							itemKey="abc_rinker"
							label={ __( 'Use Rinker', 'ad-block-counter' ) }
						/>
					</Items>
					<Items
						title={ __( 'Rinker classes', 'ad-block-counter' ) }
						classValue="rinker-classes"
					>
						<ShowRinkerClasses />
					</Items>
				</apiContext.Provider>
			) : (
				<Placeholder label={ __( 'Data loading', 'admin-bar-tools' ) }>
					<Spinner />
				</Placeholder>
			) }
		</div>
	);
};

render( <AdminPage />, document.getElementById( 'ad-block-counter-settings' ) );
