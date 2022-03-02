import { Placeholder, Snackbar, Spinner } from '@wordpress/components';
import { render, createContext, useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import './scss/index.scss';

import { RinkerStatus } from './components/atoms/RinkerStatus';
import { ItemList } from './components/organisms/ItemsList';
import { useGetApi } from './hooks/useGetApi';
import { apiType } from './types/apiType';
import { apiContextType, noticeValueType } from './types/useContextType';
import { getApiInitValue } from './utils/constant';

export const apiContext = createContext( {} as apiContextType );

const AdminPage = () => {
	const [ apiData, setApiData ] = useState< apiType >( getApiInitValue() );
	const [ apiStatus, setApiStatus ] = useState( false );
	const [ noticeStatus, setNoticeStatus ] = useState( false );
	const [ noticeValue, setNoticeValue ] = useState(
		undefined as noticeValueType
	);
	const [ noticeMessage, setNoticeMessage ] = useState( '' );
	const [ snackbarTimer, setSnackbarTimer ] = useState( 0 );
	useGetApi( setApiData, setApiStatus );

	useEffect( () => {
		if ( noticeStatus ) {
			setSnackbarTimer(
				window.setTimeout( () => {
					setNoticeStatus( false );
				}, 4000 )
			);
		}
	}, [ noticeStatus ] );

	const mainView = () => {
		switch ( apiData.abc_rinker_status ) {
			case 0:
				return <RinkerStatus rinkerStatus={ false } />;
			case 1:
				return <RinkerStatus rinkerStatus={ true } />;
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
