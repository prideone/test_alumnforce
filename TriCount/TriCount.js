

class TriCount{

	constructor(minLength, maxLength){
		this.minLength = minLength;
    	this.maxLength = maxLength;
	}


	exceedsMaxCount(trianglesCount){

		if (trianglesCount > 1000000000) {
			return true;
		}else{
			return false;
		}
	}


	get resultCount() {
    	return this.count();
  	}

	count(){

		if (Number.isInteger(this.minLength) === false || Number.isInteger(this.maxLength) === false) {
			return false;
		}

		// Test the constraints for the size of the interval
		if (this.minLength < 1 || this.maxLength > 1000000) {
			return false;
		}

		// Test to see if maxLength is greater than minLength
		// count not possible if so
		if (this.maxLength < this.minLength) {
			return false;
		}

		var trianglesCount = 0;

		// The idea is to loop on all the size length possible and find the triangles associated with this length
		for (var i = this.minLength; i <= this.maxLength; i++) {

			// Initialize the bigger side of a triangle which is now at least i (for equilateral triangles)
			var biggestSide = i;

			// Find the triangles associated with i and all other sides
			// We will iterate on the other smaller side and find each time the triangles associated with the side i, otherSmallSide (j) and biggestSide
			for (var j = i; j <= this.maxLength; j++) {
				
				// Find the triangles that satisfies the constraint for a proper triangle
				// 1 - sum of the two smaller sides of a triangle must be greater than the length of the biggest side
				while(i+j > biggestSide && biggestSide <= this.maxLength){
					biggestSide ++;
				}

				// at the end of the while loop we get the size of the biggest tlength possible with the other sides being i and j

				// It mean that we have biggestSide minus j triangles possibles with i and j fixed
				trianglesCount += biggestSide - j;
				if (this.exceedsMaxCount(trianglesCount)) {
					return -1;
				}

			}

		}

		return trianglesCount;
	}
}
