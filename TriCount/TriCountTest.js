describe("Class to count triangles", function() {
	it("Should obtain a certain numbers of triangles (large interval)", function() {
		const triCountOne = new TriCount(19, 1000);
		var countOne = triCountOne.resultCount;
  		expect(countOne).toBe(83540657);
	});

	it("Should obtain a certain numbers of triangles (small interval)", function() {
		const triCountTwo = new TriCount(9, 10);
		var countTwo = triCountTwo.resultCount;
  		expect(countTwo).toBe(4);
	});

	it("Should obtain -1 because the number of triangles is above 1 billion", function() {
		const triCountThree = new TriCount(1, 1000000);
		var countThree = triCountThree.resultCount;
  		expect(countThree).toBe(-1);
	});

	it("Should obtain false because minLength is greater than maxLength", function() {
		const triCountFour = new TriCount(10, 8);
		var countFour = triCountFour.resultCount;
  		expect(countFour).toBe(false);
	});

	it("Should obtain false because minLength not a integer", function() {
		const triCountFive = new TriCount('a', 8);
		var countFive = triCountFive.resultCount;
  		expect(countFive).toBe(false);
	});
});