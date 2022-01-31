export const PREFIX = 'abc';

export const addPrefix = ( value: string ): string => {
	return PREFIX + '_' + value;
};
