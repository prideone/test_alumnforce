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
});