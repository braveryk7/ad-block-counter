import { Placeholder, Snackbar, Spinner } from '@wordpress/components';
import { render, createContext, useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import './scss/index.scss';
import { ActivateRinker } from './components/molecules/ActivateRinker';
import { InstallRinker } from './components/molecules/InstallRinker';
import { ItemList } from './components/organisms/ItemsList';
import { useGetApi } from './hooks/useGetApi';
import { apiType } from './types/apiType';
import { apiContextType, noticeValueType } from './types/useContextType';

export const apiContext = createContext( {} as apiContextType );

const AdminPage = () => {
	const [ apiData, setApiData ] = useState< apiType >( {} );
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

	const mainView = () => {
		switch ( apiData.abc_rinker_status ) {
			case 0:
				return <InstallRinker />;
			case 1:
				return <ActivateRinker />;
			default:
				return <ItemList />;
		}
	};

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
					{ mainView() }
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
