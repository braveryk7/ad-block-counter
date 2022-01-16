export const createClassName = () => {
	const strs = 'qwertyasdfghzxcvbn1234567890';
	let rinkerClassName = '';
	for ( let i = 0; i < 12; i++ ) {
		rinkerClassName += strs.charAt(
			Math.floor( Math.random() * strs.length )
		);
	}
	return rinkerClassName;
};
